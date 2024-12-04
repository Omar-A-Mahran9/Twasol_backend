<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('dashboard.partials.master', function ($view) {
            $unreadNotifications = auth()->user()->unreadNotifications();
            $allNotifications    = auth()->user()->notifications();
            // dd($unreadNotifications);
            $view->with(['unreadNotifications' => $unreadNotifications, "allNotifications" => $allNotifications]);
        });

        View::composer('dashboard.partials.sidebar', function ($view) {
            $unreadNotifications = auth()->user()->unreadNotifications()->take(5)->get();
            $view->with(['unreadNotifications' => $unreadNotifications]);
        });

        View::composer('vendor-dashboard.partials.master', function ($view) {
            $unreadNotifications = auth()->user()->unreadNotifications();
            $allNotifications    = auth()->user()->notifications();
            // dd($unreadNotifications);

            $view->with(['unreadNotifications' => $unreadNotifications, "allNotifications" => $allNotifications]);
        });

        View::composer('vendor-dashboard.partials.sidebar', function ($view) {
            $unreadNotifications = auth()->user()->unreadNotifications()->take(5)->get();
            $view->with(['unreadNotifications' => $unreadNotifications]);
        });
    }
}
