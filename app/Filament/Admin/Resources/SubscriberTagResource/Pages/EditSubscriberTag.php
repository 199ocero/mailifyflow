<?php

namespace App\Filament\Admin\Resources\SubscriberTagResource\Pages;

use App\Filament\Admin\Resources\SubscriberTagResource;
use Filament\Resources\Pages\EditRecord;

class EditSubscriberTag extends EditRecord
{
    protected static string $resource = SubscriberTagResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
