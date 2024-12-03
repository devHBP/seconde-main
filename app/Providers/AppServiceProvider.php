<?php

namespace App\Providers;

use App\Models\Account;
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
        define('SUPER_ADMIN_LOGIN', env('SUPER_ADMIN_LOGIN'));
        
        View::composer('*', function($view){
            if(Auth::check()){
                $account = Auth::user();
                $picturePath = $account->picture !== null ? $account->picture->path : null;
                
                $theme = [
                    'background_primary' => $account->custom_background_primary ?? '#ffffff',
                    'background_secondary' => $account->custom_background_secondary ?? '#f0f0f0',
                    'font_primary' => $account->custom_font_primary ?? '#000000',
                    'font_secondary' => $account->custom_font_secondary ?? '#333333',
                    'pattern_logo' => '/storage/' . $picturePath,
                ];
                $view->with('theme', $theme);
            }
        });
        View::composer('components.*', function($view){
            $account = Account::where('slug', request()->route('account_slug'))->first();
            $view->with('accountName', $account ? $account->name : "");
        });
    }
}
