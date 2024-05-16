<?php

namespace App\Filament\Admin\Resources\TeamUserResource\Pages;

use App\Filament\Admin\Resources\TeamUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTeamUser extends CreateRecord
{
    protected static string $resource = TeamUserResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
