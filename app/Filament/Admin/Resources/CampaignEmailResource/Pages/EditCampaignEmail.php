<?php

namespace App\Filament\Admin\Resources\CampaignEmailResource\Pages;

use App\Filament\Admin\Resources\CampaignEmailResource;
use Filament\Resources\Pages\EditRecord;

class EditCampaignEmail extends EditRecord
{
    protected static string $resource = CampaignEmailResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
