<?php

namespace App\Filament\Admin\Resources\TeamUserResource\Pages;

use App\Filament\Admin\Resources\TeamUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTeamUsers extends ListRecords
{
    protected static string $resource = TeamUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
