<?php

namespace App\Filament\Admin\Resources\EmailServiceResource\Pages;

use App\Filament\Admin\Resources\EmailServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmailServices extends ListRecords
{
    protected static string $resource = EmailServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
