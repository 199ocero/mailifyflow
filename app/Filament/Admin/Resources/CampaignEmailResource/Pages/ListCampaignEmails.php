<?php

namespace App\Filament\Admin\Resources\CampaignEmailResource\Pages;

use App\Filament\Admin\Resources\CampaignEmailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCampaignEmails extends ListRecords
{
    protected static string $resource = CampaignEmailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
