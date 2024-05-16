<?php

namespace App\Filament\Admin\Resources\CampaignStatusResource\Pages;

use App\Filament\Admin\Resources\CampaignStatusResource;
use Filament\Resources\Pages\EditRecord;

class EditCampaignStatus extends EditRecord
{
    protected static string $resource = CampaignStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
