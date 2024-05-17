<?php

namespace App\Providers;

use App\Models\EmailList;
use App\Models\EmailProvider;
use App\Models\Template;
use App\Observers\EmailListObserver;
use App\Observers\EmailProviderObserver;
use App\Observers\TemplateObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentView;

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
        Template::observe(TemplateObserver::class);
        EmailProvider::observe(EmailProviderObserver::class);
        EmailList::observe(EmailListObserver::class);
    }
}
