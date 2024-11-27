<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Brand;
use App\Models\Picture;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function simulate($account_slug, Request $request){
        
        $account = Account::where('slug', $account_slug)->first();
        
        // Récup de tout les paramètres nécéssaire sans charger Account dans la vue
        $accountName = $account->name;
        $accountSlug = $account->slug;
        $customBgPrimary = $account->custom_background_primary;
        $customBgSecondary = $account->custom_background_secondary;
        $customFontPrimary = $account->custom_font_primary;
        $customFontSecondary = $account->custom_font_secondary;
        $patternId = $account->pattern_logo;
        $pattern = Picture::findOrFail($patternId);
        $patternPath = $pattern->path;

        $types = Type::where('account_id', $account->id)->get();
        $brands = Brand::where('account_id', $account->id)->get();
        $product = '';
        $states = [];
        $selectedState = null;

        if($request->isMethod('post')){
            // Cas du post de data 
            $product = null;
            $states = [];
            $stateId = null;

            // Penser à faire passer de la validated data
            
            if($request->has('type_id')){
                session(['type_id' => $request->input('type_id')]);
            }
            if($request->has('brand_id')){
                session(['brand_id' => $request->input('brand_id')]);
            }
            if($request->has('state_id')){
                session(['state_id' => $request->input('state_id')]);
            }

            $typeId = session('type_id');
            $brandId = session('brand_id');
            $stateId = session('state_id');

            if($typeId){
                $brands = Brand::whereHas('products', function($query) use ($typeId){
                    $query->where('type_id', $typeId);
                })->distinct()->get();
            }

            if($typeId && $brandId){
                $product = Product::where('type_id', $typeId)
                    ->where('brand_id', $brandId)
                    ->first();
                
                if($product){
                    $states = $product->states()->get();
                    if($stateId){
                        $selectedState = $states->firstWhere('id', $stateId);
                    }
                }
            }
            
            // Validation, Controle
            // Creation d'un panier ou retour en arrière 
            return view('visitor.simulation', compact(
                'accountName',
                'accountSlug',
                'customBgPrimary',
                'customBgSecondary',
                'customFontPrimary',
                'customFontSecondary',
                'patternPath',
                'states',
                'product',
                'brands',
                'types',
                'selectedState',
            ));
        }
        return view('visitor.simulation', [
            'accountName' => $accountName,
            'accountSlug' => $accountSlug,
            'customBgPrimary' => $customBgPrimary,
            'customBgSecondary' => $customBgSecondary,
            'customFontPrimary' => $customFontPrimary,
            'customFontSecondary' => $customFontSecondary,
            'patternPath' => $patternPath,
            'types' => $types,
            'brands' => $brands,
            'product' => $product,
            'states' => $states,
            'selectedState' => $selectedState
        ]);
    }

    public function cleanSession($account_slug)
    {
        $this->forgetMyProductInSession();
        return redirect()->route('simulateur.selection', $account_slug);
    }

    /**
     * Fonction utilitaire pour supprimer un produit de la session
     * @return void
     */
    public function forgetMyProductInSession(): void
    {
        if(session('type_id')){
            session()->forget('type_id');
        }
        if(session('brand_id')){
            session()->forget('brand_id');
        }
        if(session('state_id')){
            session()->forget('state_id');
        }
    }
}