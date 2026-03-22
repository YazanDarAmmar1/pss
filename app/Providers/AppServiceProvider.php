<?php

namespace App\Providers;

use App\Events\UserPaymentDone;
use App\Listeners\freshProjectTotals;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once base_path() . '/app/Helper/HomeModals.php';
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        url()->defaults([
            'locale' => app()->getLocale(),
        ]);
        Event::listen(
            UserPaymentDone::class,
            [freshProjectTotals::class, 'handle']
        );
    }
}
