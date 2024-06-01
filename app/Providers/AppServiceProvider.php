<?php

namespace App\Providers;

use App\Models\EmailList;
use App\Models\EmailProvider;
use App\Models\Template;
use App\Observers\EmailListObserver;
use App\Observers\EmailProviderObserver;
use App\Observers\TemplateObserver;
use Filament\Forms\Components\Select;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        parent::register();
        FilamentView::registerRenderHook('panels::body.end', fn (): string => Blade::render("@vite('resources/js/app.js')"));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Select::configureUsing(function (Select $select): void {
            $select->native(false);
        });

        Template::observe(TemplateObserver::class);
        EmailProvider::observe(EmailProviderObserver::class);
        EmailList::observe(EmailListObserver::class);
    }
}
