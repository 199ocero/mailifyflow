<?php

namespace App\Filament\Admin\Resources\EmailServiceTypeResource\Pages;

use App\Filament\Admin\Resources\EmailServiceTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEmailServiceType extends CreateRecord
{
    protected static string $resource = EmailServiceTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
