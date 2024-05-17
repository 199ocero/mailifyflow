<?php

namespace App\Observers;

use App\Models\EmailList;
use Filament\Facades\Filament;

class EmailListObserver
{
    public function creating(EmailList $emailList): void
    {
        if (auth()->check()) {
            $emailList->team_id = Filament::getTenant()->id;
        }
    }
}
