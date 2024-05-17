<?php

namespace App\Observers;

use App\Models\EmailProvider;
use Filament\Facades\Filament;

class EmailProviderObserver
{
    /**
     * Handle the EmailProvider "created" event.
     */
    public function creating(EmailProvider $emailProvider): void
    {
        if (auth()->check()) {
            $emailProvider->team_id = Filament::getTenant()->id;
        }
    }

    /**
     * Handle the EmailProvider "created" event.
     */
    public function created(EmailProvider $emailProvider): void
    {
        //
    }

    /**
     * Handle the EmailProvider "updated" event.
     */
    public function updated(EmailProvider $emailProvider): void
    {
        //
    }

    /**
     * Handle the EmailProvider "deleted" event.
     */
    public function deleted(EmailProvider $emailProvider): void
    {
        //
    }

    /**
     * Handle the EmailProvider "restored" event.
     */
    public function restored(EmailProvider $emailProvider): void
    {
        //
    }

    /**
     * Handle the EmailProvider "force deleted" event.
     */
    public function forceDeleted(EmailProvider $emailProvider): void
    {
        //
    }
}
