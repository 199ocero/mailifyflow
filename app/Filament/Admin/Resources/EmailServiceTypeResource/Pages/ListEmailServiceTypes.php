<?php

namespace App\Filament\Admin\Resources\EmailServiceTypeResource\Pages;

use App\Filament\Admin\Resources\EmailServiceTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmailServiceTypes extends ListRecords
{
    protected static string $resource = EmailServiceTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
