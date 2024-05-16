<?php

namespace App\Filament\Admin\Resources\CampaignStatusResource\Pages;

use App\Filament\Admin\Resources\CampaignStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCampaignStatuses extends ListRecords
{
    protected static string $resource = CampaignStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
