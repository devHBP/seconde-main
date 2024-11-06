<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FakeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;


Route::get('register', [RegisteredUserController::class, 'create'])->name('auth.register');
Route::post('register', [RegisteredUserController::class, 'store']);

Route::middleware('auth')->group(function (){
    Route::get('/', [HomeController::class, 'getHomePage'])->name('dashboard');
    Route::post('/session', [RoleController::class, 'showRoleLogin'])->name('role.sublogin');
    Route::post('/{role_name}/login', [RoleController::class, 'authenticate'])->name('role.authenticate');
    Route::get('/{role_name}/logout', [RoleController::class, 'destroy']);
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

Route::middleware(['auth', 'subsession.role'])->group(function(){
    /**
     * Routes concernant les admins
     */
    Route::get('/administrateur/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Gestion des Utilisateurs
    Route::get('/administrateur/users', [AdminController::class, 'getUsers'])->name('admin.users');
    Route::get('/administrateur/user/create', [AdminController::class, 'createUser'])->name('admin.user.create'); //Formulaire de création utilisateur
    Route::post('/administrateur/user/create', [AdminController::class, 'createUser']);
    Route::get('/administrateur/user/{user_id}', [AdminController::class, 'modifyUser'])->name('admin.user.modify'); // Formulaire
    Route::put('/administrateur/user/{user_id}', [AdminController::class, 'modifyUser']);
    Route::delete('/administrateur/user/{user_id}', [AdminController::class, 'deleteUser']);
    
    /**
     * Routes concernant l'encaissement
     */

    /**
     * Routes concernant la reception
     */

    /**
     * Routes concernant les visiteurs
     */

});

 require __DIR__.'/auth.php';