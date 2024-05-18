<?php

namespace App\Filament\Admin\Resources\EmailProviderResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Admin\Resources\EmailProviderResource;

class ListEmailProviders extends ListRecords
{
    protected static string $resource = EmailProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add New Email Provider')
                ->icon('heroicon-o-plus'),
        ];
    }
}
