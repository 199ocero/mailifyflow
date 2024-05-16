<?php

namespace App\Filament\Admin\Resources\EmailServiceResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Admin\Resources\EmailProviderResource;

class EditEmailProvider extends EditRecord
{
    protected static string $resource = EmailProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
