<?php

namespace App\Filament\Admin\Resources\EmailListResource\Pages;

use App\Filament\Admin\Resources\EmailListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmailLists extends ListRecords
{
    protected static string $resource = EmailListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add New Email List')
                ->icon('heroicon-o-plus'),
        ];
    }
}
