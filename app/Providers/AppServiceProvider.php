<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
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
        View::composer('*', function($view){
            if(Auth::check()){
                $account = Auth::user();
                $theme = [
                    'background_primary' => $account->custom_background_primary ?? '#ffffff',
                    'background_secondary' => $account->custom_background_secondary ?? '#f0f0f0',
                    'font_primary' => $account->custom_font_primary ?? '#000000',
                    'font_secondary' => $account->custom_font_secondary ?? '#333333',
                ];
                $view->with('theme', $theme);
            }
        });
    }
}
