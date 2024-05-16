<?php

namespace App\Filament\Admin\Resources\UnsubscribeEventTypeResource\Pages;

use App\Filament\Admin\Resources\UnsubscribeEventTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUnsubscribeEventTypes extends ListRecords
{
    protected static string $resource = UnsubscribeEventTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
