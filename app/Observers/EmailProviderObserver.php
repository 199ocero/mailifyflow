<?php

namespace App\Observers;

use App\Models\EmailProvider;
use Filament\Facades\Filament;

class EmailProviderObserver
{
    public function creating(EmailProvider $emailProvider): void
    {
        if (auth()->check()) {
            $emailProvider->team_id = Filament::getTenant()->id;
        }
    }
}
