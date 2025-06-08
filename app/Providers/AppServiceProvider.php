<?php

namespace App\Providers;

use App\Models\MessageT;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $unreadCount = MessageT::where('receiver_id', auth()->id())
                    ->whereNull('read_at')
                    ->count();

                $view->with('unreadMessages', $unreadCount);
            }
        });
    }
}
