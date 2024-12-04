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
                    'header_background' => $account->header_background ?? '#ffffff',
                    'header_title' => $account->header_title ?? '#f0f0f0',
                    'header_subtitle' => $account->header_subtitle ?? '#000000',
                    'header_button_background' => $account->header_button_background ?? '#333333',
                    'header_button_font' => $account->header_button_font ?? '#333333',
                    
                    'subheader_background' => $account->subheader_background ?? '#ffffff',
                    'subheader_title' => $account->subheader_title ?? '#f0f0f0',
                    'subheader_subtitle' => $account->subheader_subtitle ?? '#000000',
                    'subheader_button' => $account->subheader_button ?? '#333333',
                    'subheader_button_font' => $account->subheader_button_font ?? '#333333',

                    'main_background' => $account->main_background ?? '#ffffff',
                    'main_cards_background' => $account->main_cards_background ?? '#f0f0f0',
                    'main_cards_title' => $account->main_cards_title ?? '#000000',
                    'main_cards_font' => $account->main_cards_font ?? '#333333',
                    'main_cards_svg' => $account->main_cards_svg ?? '#333333',
                    'main_cards_button' => $account->main_cards_button ?? '#333333',

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
