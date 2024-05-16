<?php

namespace App\Filament\Admin\Resources\EmailServiceResource\Pages;

use App\Filament\Admin\Resources\EmailServiceResource;
use Filament\Resources\Pages\EditRecord;

class EditEmailService extends EditRecord
{
    protected static string $resource = EmailServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
