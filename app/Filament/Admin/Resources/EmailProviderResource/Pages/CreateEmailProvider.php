<?php

namespace App\Filament\Admin\Resources\EmailServiceResource\Pages;

use App\Filament\Admin\Resources\EmailProviderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEmailProvider extends CreateRecord
{
    protected static string $resource = EmailProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
