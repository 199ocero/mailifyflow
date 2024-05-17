<?php

namespace App\Filament\Admin\Resources\EmailListResource\Pages;

use App\Filament\Admin\Resources\EmailListResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmailList extends CreateRecord
{
    protected static string $resource = EmailListResource::class;
}
