<?php

namespace App\Observers;

use App\Models\Template;
use Filament\Facades\Filament;

class TemplateObserver
{
    public function creating(Template $template): void
    {
        if (auth()->check()) {
            $template->team_id = Filament::getTenant()->id;
        }
    }
}
