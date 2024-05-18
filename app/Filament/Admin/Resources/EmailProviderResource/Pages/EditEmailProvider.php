<?php

namespace App\Filament\Admin\Resources\EmailProviderResource\Pages;

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
        return [];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $config = Crypt::decrypt($data['config']);

        $data['host'] = $config['host'];
        $data['port'] = $config['port'];
        $data['encryption'] = $config['encryption'];
        $data['username'] = $config['username'];
        $data['password'] = $config['password'];

        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['config'] = Crypt::encrypt(
            [
                'host' => $data['host'],
                'port' => $data['port'],
                'encryption' => $data['encryption'],
                'username' => $data['username'],
                'password' => $data['password']
            ]
        );

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
