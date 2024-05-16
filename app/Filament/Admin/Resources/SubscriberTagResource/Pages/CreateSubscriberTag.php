<?php

namespace App\Filament\Admin\Resources\SubscriberTagResource\Pages;

use App\Filament\Admin\Resources\SubscriberTagResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSubscriberTag extends CreateRecord
{
    protected static string $resource = SubscriberTagResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
