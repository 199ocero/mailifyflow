<?php

namespace App\Filament\Admin\Resources\TagResource\Pages;

use App\Filament\Admin\Resources\TagResource;
use Filament\Resources\Pages\EditRecord;

class EditTag extends EditRecord
{
    protected static string $resource = TagResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
