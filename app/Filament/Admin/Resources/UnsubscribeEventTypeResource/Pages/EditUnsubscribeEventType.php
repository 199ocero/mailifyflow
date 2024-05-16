<?php

namespace App\Filament\Admin\Resources\UnsubscribeEventTypeResource\Pages;

use App\Filament\Admin\Resources\UnsubscribeEventTypeResource;
use Filament\Resources\Pages\EditRecord;

class EditUnsubscribeEventType extends EditRecord
{
    protected static string $resource = UnsubscribeEventTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
