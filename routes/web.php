<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\EncaissementController;
use App\Http\Controllers\FakeController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VisitorController;

use Illuminate\Support\Facades\Route;


Route::get('register', [RegisteredUserController::class, 'create'])->name('auth.register');
Route::post('register', [RegisteredUserController::class, 'store']);

Route::middleware('auth')->group(function (){
    Route::get('/', [HomeController::class, 'getHomePage'])->name('dashboard');
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

Route::middleware(['auth', 'super_admin'])->group(function(){
    // Self Settings
    Route::get('/gestion/settings', [GestionController::class, 'getSettings'])->name('gestion.settings');
    Route::put('/gestion/settings', [GestionController::class, 'getSettings'])->name('gestion.settings.update');

    // Route de gestion des enseignes , création, modification, suppression
    Route::get('/gestion/enseigne/create', [GestionController::class, 'createEnseigne'])->name('gestion.create.enseigne');
    // Sur cette route, penser à implémenter le 1er admin à la volée.
    Route::post('/gestion/enseigne/create', [GestionController::class, 'createEnseigne'])->name('gestion.store.enseigne');
    
    Route::get('/gestion/{enseigne_slug}', [GestionController::class, 'getEnseigne'])->name('gestion.get.enseigne');
    Route::get('/gestion/{enseigne_slug}/modify', [GestionController::class, 'modifyEnseigneDetails'])->name('gestion.modify.enseigne.view');
    Route::put('/gestion/{enseigne_slug}/modify', [GestionController::class, 'modifyEnseigneDetails'])->name('gestion.modify.enseigne');
    Route::delete('/gestion/{enseigne_slug}/delete', [GestionController::class, 'deleteEnseigne'])->name('gestion.delete.enseigne');
    
    // Route de gestion des utilisateurs /enseigne , ajout, modification, suppression
    Route::get('/gestion/{enseigne_slug}/users', [GestionController::class, 'getUsers'])->name('gestion.get.users');
    Route::get('/gestion/{enseigne_slug}/user',[GestionController::class, 'createUser'])->name('gestion.create.user');
    Route::post('/gestion/{enseigne_slug}/user',[GestionController::class, 'createUser'])->name('gestion.store.user');
    Route::get('/gestion/{enseigne_slug}/user/{user_id}', [GestionController::class, 'getOneUser'])->name('gestion.get.user'); // Formulaire
    Route::put('/gestion/{enseigne_slug}/user/{user_id}', [GestionController::class, 'modifyOneUser'])->name('gestion.modify.user');
    Route::delete('/gestion/{enseigne_slug}/user/{user_id}', [GestionController::class, 'deleteOneUser'])->name('gestion.delete.user');
    
    // Route de gestion des types
    Route::get('/gestion/{enseigne_slug}/types', [GestionController::class, 'getTypes'])->name('gestion.get.types');
    Route::get('/gestion/{enseigne_slug}/type', [GestionController::class, 'createType'])->name('gestion.create.type'); // Formulaire
    Route::post('/gestion/{enseigne_slug}/type', [GestionController::class, 'storeType'])->name('gestion.store.type');
    Route::get('/gestion/{enseigne_slug}/type/{type_id}', [GestionController::class, 'getOneType'])->name('gestion.get.type'); // Formulaire
    Route::put('/gestion/{enseigne_slug}/type/{type_id}', [GestionController::class, 'modifyOneType'])->name('gestion.modify.type');
    Route::delete('/gestion/{enseigne_slug}/type/{type_id}', [GestionController::class, 'deleteOneType'])->name('gestion.delete.type');

    // Route de gestion des marques
    Route::get('/gestion/{enseigne_slug}/brands', [GestionController::class, 'getBrands'])->name('gestion.get.brands');
    Route::get('/gestion/{enseigne_slug}/brand', [GestionController::class, 'createBrand'])->name('gestion.create.brand'); // Formulaire
    Route::post('/gestion/{enseigne_slug}/brand', [GestionController::class, 'storeBrand'])->name('gestion.store.brand');
    Route::get('/gestion/{enseigne_slug}/brand/{brand_id}', [GestionController::class, 'getOneBrand'])->name('gestion.get.brand'); // Formulaire
    Route::put('/gestion/{enseigne_slug}/brand/{brand_id}', [GestionController::class, 'modifyOneBrand'])->name('gestion.modify.brand');
    Route::delete('/gestion/{enseigne_slug}/brand/{brand_id}', [GestionController::class, 'deleteOneBrand'])->name('gestion.delete.brand');

    // Route de gestion des produits
    Route::get('/gestion/{enseigne_slug}/products', [GestionController::class, 'getProducts'])->name('gestion.get.products');
    Route::get('/gestion/{enseigne_slug}/product', [GestionController::class, 'createProduct'])->name('gestion.create.product'); // Formulaire
    Route::post('/gestion/{enseigne_slug}/product', [GestionController::class, 'storeProduct'])->name('gestion.store.product');
    Route::get('/gestion/{enseigne_slug}/product/{product_id}', [GestionController::class, 'getOneProduct'])->name('gestion.get.product'); // Formulaire
    Route::put('/gestion/{enseigne_slug}/product/{product_id}', [GestionController::class, 'modifyOneProduct'])->name('gestion.modify.product');
    Route::delete('/gestion/{enseigne_slug}/product/{product_id}', [GestionController::class, 'deleteOneProduct'])->name('gestion.delete.product');

    // Route gestion des tickets
    Route::get('/gestion/{enseigne_slug}/tickets', [GestionController::class, 'getTickets'])->name('gestion.get.tickets');
    // A Voir si besoin de plus de routes.

});

Route::middleware(['auth', 'subsession'])->group(function(){
    // Connexion aux sublogin
    Route::post('/session', [RoleController::class, 'showRoleLogin'])->name('role.sublogin');
    Route::post('/{role_name}/login', [RoleController::class, 'authenticate'])->name('role.authenticate');
    Route::get('/session/logout', [RoleController::class, 'destroy'])->name('role.logout');
    /**
     * Routes concernant les admins
     */
    Route::get('/administrateur/settings', [AdminController::class, 'getSettings'])->name('admin.settings');
    Route::put('/administrateur/settings', [AdminController::class, 'getSettings'])->name('admin.settings.update');
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
    Route::get('/administrateur/produits/filter-name/{filter_name}', [AdminController::class, 'dropSessionFilters'])->name('admin.products.drop.filters');
    // Tickets remises et Statistiques
    Route::get('/administrateur/tickets', [AdminController::class, 'getTickets'])->name('admin.tickets');
    Route::get('/administrateur/tickets/search', [AdminController::class, 'searchTicket'])->name('admin.search.tickets');
    Route::get('/administrateur/tickets/{ticket_id}', [AdminController::class, 'showTicket'])->name('admin.ticket.show');
    Route::get('/administrateur/tickets/{ticket_id}/email', [AdminController::class, 'sendReditTicket'])->name('admin.ticket.send');
    Route::get('/administrateur/tickets/{ticket_id}/print', [AdminController::class, 'printReditTicketView'])->name('admin.ticket.print');
    Route::get('/administrateur/tickets/{ticket_id}/print/pdf', [AdminController::class, 'printReditTicket'])->name('admin.ticket.print.embeded');
    Route::get('/administrateur/stats', [AdminController::class, 'getStats'])->name('admin.stats');
    Route::get('/administrateur/clients', [AdminController::class, 'getClients'])->name('admin.clients');
    Route::get('/administarteur/clients/search', [AdminController::class, 'searchClients'])->name('admin.clients.search');
    Route::get('/administrateur/clients/{client_id}', [AdminController::class , 'showClient'])->name('admin.clients.show');
    Route::post('/administrateur/clients/{client_id}/update', [AdminController::class, 'updateClient'])->name('admin.clients.update');

    /**
     * Routes concernant la reception
     */
    Route::get('/reception/dashboard', [ReceptionController::class, 'dashboard'])->name('reception.dashboard');
    // Reprise de produits -> post et stockage en session en dans le storage ?
    Route::get('/reception/produit', [ReceptionController::class, 'addProduct'])->name('reception.add.product');
    Route::post('/reception/produit', [Receptioncontroller::class, 'addProduct'])->name('reception.selection.store');
    //Route::post('/reception/finalize', [ReceptionController::class, 'finalize'])->name('reception.product.finalize');
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
    Route::get('/reception/panier', [ReceptionController::class, 'getCart'])->name('reception.cart');
    Route::post('/reception/panier', [ReceptionController::class, 'addToCart'])->name('reception.cart.add');
    Route::post('/reception/panier/increase', [ReceptionController::class, 'increaseQuantity'])->name('reception.cart.increase');
    Route::post('/reception/panier/decrease', [ReceptionController::class, 'decreaseQuantity'])->name('reception.cart.decrease');
    Route::delete('/reception/panier/products', [ReceptionController::class, 'dropProducts'])->name('reception.cart.drop.products');
    Route::delete('/reception/panier/drop', [ReceptionController::class, 'dropCart'])->name('reception.cart.drop');
    Route::post('/reception/panier/validate', [ReceptionController::class, 'validate'])->name('reception.cart.validate');
    Route::get('/reception/panier/validate/search', [ReceptionController::class, 'showClientSearch'])->name('reception.cart.search');
    Route::post('/reception/panier/associate', [Receptioncontroller::class, 'associate'])->name('reception.cart.associate');
    // Gestion des panier à restituer 
    Route::get('/reception/paniers/retours', [ReceptionController::class, 'getAllCartsToReturn'])->name('reception.carts.to-return');
    Route::get('/reception/panier/search', [ReceptionController::class, 'cartToSearch'])->name('reception.cart.search.return');
    Route::get('/reception/panier/{panier_id}/retour', [ReceptionController::class, 'cartToReturn'])->name('reception.cart.to-return');
    Route::post('/reception/panier/{panier_id}/retour', [ReceptionController::class, 'cartToReturn'])->name('reception.cart.returned');
    // Génération du ticket depuis la Reception
    Route::get('/reception/panier/generate/{panier_id}',[ReceptionController::class, 'generateTicketReprise'])->name('reception.cart.generate');
    Route::get('/reception/panier/{ticket_uuid}/print', [ReceptionController::class, 'printTicket'])->name('reception.ticket.print');
    Route::get('/reception/ticket/{ticket_uuid}/print', [ReceptionController::class, 'printTicketEmbededView'])->name('reception.ticket.print.get');

    /**
     * Routes concernant l'encaissement
     */
    Route::get('/encaissement/dashboard', [EncaissementController::class, 'dashboard'])->name('encaissement.dashboard');
    Route::get('/encaissement/ticket/search', [EncaissementController::class, 'searchTicket'])->name('encaissement.ticket.search');
    Route::post('/encaissement/ticket/validate', [EncaissementController::class, 'consumeTicket'])->name('encaissement.ticket.consume');
    Route::post('/encaissement/ticket/restitute', [EncaissementController::class, 'restituteTicket'])->name('encaissement.ticket.restitute');
    Route::get('/encaissement/ticket/restitute/{ticket_uuid}',[EncaissementController::class, 'restituteIFrameRedirect']);
    Route::get('/encaissement/ticket/restitute/{ticket_uuid}/print', [EncaissementController::class, 'printTicketOfRestitute'])->name('encaissement.ticket.restitute.print');
    Route::get('/encaissement/ticket/{ticket_uuid}', [EncaissementController::class, 'showTicket'])->name('encaissement.ticket.show');
    Route::get('/encaissement/ticket/{ticket_uuid}/print', [EncaissementController::class, 'printTicket'])->name('encaissement.ticket.print');
    Route::get('/encaissement/ticket/{ticket_uuid}/generate', [EncaissementController::class, 'printTicketUsed'])->name('encaissement.ticket.print.used');
    Route::get('/encaissement/ticket/supplier/{ticket_uuid}/print', [EncaissementController::class, 'printSupplierDelivery'])->name('encaissement.ticket.supplier.print');
    Route::get('/encaissement/ticket/supplier/{ticket_uuid}/generate', [EncaissementController::class, 'generateSupplierDelivery'])->name('encaissement.ticket.supplier.generate');
});

Route::get('/simulateur/{account_slug}', [VisitorController::class, 'simulate'])->name('simulateur.selection');
Route::get('/simulateur/{account_slug}/clean', [VisitorController::class, 'cleanSession'])->name('simulateur.clean');
Route::post('/simulateur/{account_slug}', [VisitorController::class, 'simulate'])->name('simulateur.selection.store');

 require __DIR__.'/auth.php';