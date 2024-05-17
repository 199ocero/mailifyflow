<?php

namespace App\Observers;

use App\Models\EmailList;
use Filament\Facades\Filament;

class EmailListObserver
{
    /**
     * Handle the EmailList "creating" event.
     */
    public function creating(EmailList $emailList): void
    {
        if (auth()->check()) {
            $emailList->team_id = Filament::getTenant()->id;
        }
    }

    /**
     * Handle the EmailList "created" event.
     */
    public function created(EmailList $emailList): void
    {
        Filament::getTenant()->emailLists()->attach($emailList->id);
    }

    /**
     * Handle the EmailList "updated" event.
     */
    public function updated(EmailList $emailList): void
    {
        //
    }

    /**
     * Handle the EmailList "deleted" event.
     */
    public function deleted(EmailList $emailList): void
    {
        Filament::getTenant()->emailLists()->detach($emailList->id);
    }

    /**
     * Handle the EmailList "restored" event.
     */
    public function restored(EmailList $emailList): void
    {
        //
    }

    /**
     * Handle the EmailList "force deleted" event.
     */
    public function forceDeleted(EmailList $emailList): void
    {
        //
    }
}
