<?php

namespace App\Filament\Admin\Resources\EmailProviderResource\Pages;

use App\Filament\Admin\Resources\EmailProviderResource;
use App\Models\EmailProviderType;
use App\Enum\EmailProviderType as EmailProviderTypeEnum;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Crypt;

class CreateEmailProvider extends CreateRecord
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
    protected function mutateFormDataBeforeCreate(array $data): array
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
