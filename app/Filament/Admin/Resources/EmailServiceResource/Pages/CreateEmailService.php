<?php

namespace App\Filament\Admin\Resources\EmailServiceResource\Pages;

use App\Filament\Admin\Resources\EmailServiceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEmailService extends CreateRecord
{
    protected static string $resource = EmailServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
