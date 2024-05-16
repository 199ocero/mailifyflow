<?php

namespace App\Filament\Admin\Resources\CampaignStatusResource\Pages;

use App\Filament\Admin\Resources\CampaignStatusResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCampaignStatus extends CreateRecord
{
    protected static string $resource = CampaignStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
