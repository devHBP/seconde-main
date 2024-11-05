<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('register', [RegisteredUserController::class, 'create'])->name('auth.register');
Route::post('register', [RegisteredUserController::class, 'store']);

Route::middleware('auth')->group(function (){
    Route::get('/', [HomeController::class, 'getHomePage']);
});



/**
 * Routes concernant les admins
 */

/**
 * Routes concernant l'encaissement
 */

/**
 * Routes concernant la reception
 */

/**
 * Routes concernant les visiteurs
 */

 require __DIR__.'/auth.php';