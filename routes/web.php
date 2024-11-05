<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FakeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;


Route::get('register', [RegisteredUserController::class, 'create'])->name('auth.register');
Route::post('register', [RegisteredUserController::class, 'store']);

Route::middleware('auth')->group(function (){
    Route::get('/', [HomeController::class, 'getHomePage']);

    Route::get('/{role_name}/login', [RoleController::class, 'showRoleLogin'])->name('role.sublogin');
});

/**
 * Routes à des fins de test uniquement 
 * ! Doit disparaitre avant la mise en production
 */
Route::middleware('auth')->group(function(){
    Route::get('/create/user', [FakeController::class, 'createUser']);
    Route::get('/users', [FakeController::class, 'getUsers'])->name('fake.users');
    Route::get('/user/{id}', [FakeController::class, 'getUser']);
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