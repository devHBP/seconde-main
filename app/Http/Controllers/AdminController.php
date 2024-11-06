<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController
{
    /**
     * Dashboard
     */
    public function dashboard()
    {
        //
    }

    /**
     * Utilisateurs
     */
    public function getUsers()
    {
        // 
    }
    
    public function createUser(Request $request)
    {
        if($request->isMethod('post')){
            // Case formulaire post
        }
        // Vue Formulaire
    }

    public function modifyUser(Request $request, $user_id)
    {
        if($request->isMethod('put')){
            // Case formulaire posté
        }
        // Vue formulaire
    }

    public function deleteUser($user_id)
    {
        //
    }

    /**
     * Marques
     */
    public function getBrands()
    {
        //
    }

    public function createBrand(Request $request)
    {
        if($request->isMethod('post')){
            // Case formulaire posté
        }
        // Vue Formulaire
    }

    public function modifyBrand(Request $request, $brand_id)
    {
        if($request->isMethod('put')){
            // Case formulaire posté
        }
        // Vue formulaire
    }

    public function deleteBrand($brand_id)
    {
        //
    }

    /**
     * Types
     */ 
    public function getTypes()
    {
        //
    }

    public function createType(Request $request)
    {
        if($request->isMethod('post')){
            //
        }
        //
    }

    public function modifyType(Request $request, $type_id)
    {
        if($request->isMethod('put')){
            //
        }
        //
    }

    public function deleteType($type_id)
    {
        //
    }

    /**
     * Etats / States
     */
    public function getStates()
    {
        //
    }

    public function createState(Request $request)
    {
        if($request->isMethod('post')){
            // Case formulaire posté
        }
        // Vue formulaire
    }

    public function modifyState(Request $request, $state_id)
    {
        if($request->isMethod('put')){
            // Case formulaire posté
        }
        // Vue formulaire
    }

    public function deleteState($state_id)
    {
        //
    }

    /**
     * Produits / Products
     */
    public function getProducts()
    {
        //
    }

    public function createProduct(Request $request)
    {
        if($request->isMethod('post')){
            // Case formulaire posté
        }
        // Vue formulaire
    }

    public function modifyProduct(Request $request, $product_id)
    {
        if($request->isMethod('put')){
            // Case formulaire posté
        }
        // Vue formulaire
    }

    public function deleteProduct($product_id)
    {
        //
    }

    /**
     * Tickets && Stats
     */
    public function getTickets()
    {
        //
    }

    public function getStats()
    {
        //
    }
}