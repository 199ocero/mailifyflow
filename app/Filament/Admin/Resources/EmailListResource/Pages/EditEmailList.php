<?php

namespace App\Filament\Admin\Resources\EmailListResource\Pages;

use App\Filament\Admin\Resources\EmailListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmailList extends EditRecord
{
    protected static string $resource = EmailListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
