<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FakeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;


Route::get('register', [RegisteredUserController::class, 'create'])->name('auth.register');
Route::post('register', [RegisteredUserController::class, 'store']);

Route::middleware('auth')->group(function (){
    Route::get('/', [HomeController::class, 'getHomePage'])->name('dashboard');
    Route::post('/session', [RoleController::class, 'showRoleLogin'])->name('role.sublogin');
    Route::post('/{role_name}/login', [RoleController::class, 'authenticate'])->name('role.authenticate');
    Route::get('/session/logout', [RoleController::class, 'destroy'])->name('role.logout');
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

Route::middleware('auth')->group(function(){
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
    Route::delete('/administrateur/user/{user_id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');
    // Gestion des marques
    Route::get('/administrateur/marques', [AdminController::class, 'getBrands'])->name('admin.brands');
    Route::get('/administrateur/marque/create', [AdminController::class, 'createBrand'])->name('admin.brand.create'); // Formulaire de création
    Route::post('/administrateur/marque/create', [AdminController::class, 'createBrand']);
    Route::get('/administrateur/marque/{brand_id}', [AdminController::class, 'modifyBrand'])->name('admin.brand.modify'); // Formulaire de modif
    Route::put('/administrateur/marque/{brand_id}', [AdminController::class, 'modifyBrand']);
    Route::delete('/administrateur/marque/{brand_id}', [AdminController::class, 'deleteBrand'])->name('admin.brand.delete');
    // Gestion des types
    Route::get('/administrateur/types', [AdminController::class, 'getTypes'])->name('admin.types');
    Route::get('/administrateur/type/create', [AdminController::class, 'createType'])->name('admin.type.create'); // Formulaire de création
    Route::post('/administrateur/type/create', [AdminController::class, 'createType']);
    Route::get('/administrateur/type/{type_id}', [AdminController::class, 'modifyType'])->name('admin.type.modify'); // Formulaire de modif
    Route::put('/administrateur/type/{type_id}', [AdminController::class, 'modifyType']);
    Route::delete('/administrateur/type/{type_id}', [AdminController::class, 'deleteType'])->name('admin.type.delete');
    // Gestion des etats 
    Route::get('/administrateur/etats', [AdminController::class, 'getStates'])->name('admin.states');
    Route::get('/administrateur/etat/create', [AdminController::class, 'createState'])->name('admin.state.create'); // Formulaire de création
    Route::post('/administrateur/etat/create', [AdminController::class, 'createState']);
    Route::get('/administrateur/etat/{state_id}', [AdminController::class, 'modifyState'])->name('admin.state.modify'); // Formulaire de modif
    Route::put('/administrateur/etat/{state_id}', [AdminController::class, 'modifyState']);
    Route::delete('/administrateur/etat/{state_id}', [AdminController::class, 'deleteState'])->name('admin.state.delete');
    // Gestion des produits
    Route::get('/administrateur/produits', [AdminController::class, 'getProducts'])->name('admin.products');
    Route::get('/administrateur/produit/create', [AdminController::class, 'createProduct'])->name('admin.product.create'); // Formulaire de création
    Route::post('/administrateur/produit/create', [AdminController::class, 'createProduct']);
    Route::get('/administrateur/produit/{product_id}', [AdminController::class, 'modifyProduct'])->name('admin.product.modify'); // Formulaire de modif
    Route::put('/administrateur/produit/{product_id}', [AdminController::class, 'modifyProduct']);
    Route::delete('/administrateur/produit/{product_id}', [AdminController::class, 'deleteProduct'])->name('admin.product.delete');
    // Tickets remises et Statistiques
    Route::get('/administrateur/tickets', [AdminController::class, 'getTickets'])->name('admin.tickets');
    Route::get('/administrateur/stats', [AdminController::class, 'getStats'])->name('admin.stats');
    
    /**
     * Routes concernant l'encaissement
     */

    /**
     * Routes concernant la reception
     */
    Route::get('/reception/dashboard', [ReceptionController::class, 'dashboard'])->name('reception.dashboard');
    // Reprise de produits -> post et stockage en session en dans le storage ?
    Route::get('/reception/produit', [ReceptionController::class, 'addProduct'])->name('reception.add.product');
    Route::post('/reception/produit', [Receptioncontroller::class, 'addProduct'])->name('reception.selection.store');
    Route::post('/reception/finalize', [ReceptionController::class, 'finalize'])->name('reception.product.finalize');
    Route::get('/reception/cancel', [ReceptionController::class, 'cancel'])->name('reception.product.cancel');
    // Gestion des clients
    Route::get('/reception/clients/', [ReceptionController::class, 'getClient'])->name('reception.clients');
    Route::get('/reception/client/create', [ReceptionController::class, 'createClient'])->name('reception.client.create');
    Route::post('/reception/client/create', [ReceptionController::class, 'createClient']);
    Route::get('/reception/client/{client_id}', [ReceptionController::class, 'showClient'])->name('reception.client.get'); 
    Route::get('/reception/client/modify/{client_id}', [ReceptionController::class, 'modifyClient'])->name('reception.client.modify');
    Route::put('/reception/client/modify/{client_id}', [ReceptionController::class, 'modifyClient']);
    Route::delete('/reception/client/delete/{client_id}', [ReceptionController::class, 'deleteClient'])->name('reception.client.delete');
    // Gestion du panier
    Route::get('/reception/cart', [ReceptionController::class, 'addToCart'])->name('reception.cart.add');
    
    /**
     * Routes concernant les visiteurs
     */

});

 require __DIR__.'/auth.php';