<?php

namespace App\Filament\Admin\Resources\EmailServiceResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Admin\Resources\EmailProviderResource;
use App\Models\EmailProviderType;
use App\Enum\EmailProviderType as EmailProviderTypeEnum;
use Illuminate\Support\Facades\Crypt;

class EditEmailProvider extends EditRecord
{
    protected static string $resource = EmailProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $emailProviderType = EmailProviderType::query()->find($data['email_provider_type_id']);

        $config = Crypt::decrypt($data['config']);

        if($emailProviderType->name == EmailProviderTypeEnum::SMTP->value){
            $data['host'] = $config['host'];
            $data['port'] = $config['port'];
            $data['encryption'] = $config['encryption'];
            $data['username'] = $config['username'];
            $data['password'] = $config['password'];
        }

        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $emailProviderType = EmailProviderType::query()->find($data['email_provider_type_id']);

        if($emailProviderType->name == EmailProviderTypeEnum::SMTP->value){
            $data['config'] = Crypt::encrypt(
                [
                    'host' => $data['host'],
                    'port' => $data['port'],
                    'encryption' => $data['encryption'],
                    'username' => $data['username'],
                    'password' => $data['password']
                ]
            );
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
