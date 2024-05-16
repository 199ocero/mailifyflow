<?php

namespace App\Filament\Admin\Resources\UnsubscribeEventTypeResource\Pages;

use App\Filament\Admin\Resources\UnsubscribeEventTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUnsubscribeEventType extends CreateRecord
{
    protected static string $resource = UnsubscribeEventTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
