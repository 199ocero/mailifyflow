<?php

namespace App\Filament\Admin\Resources\SubscriberTagResource\Pages;

use App\Filament\Admin\Resources\SubscriberTagResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubscriberTags extends ListRecords
{
    protected static string $resource = SubscriberTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
