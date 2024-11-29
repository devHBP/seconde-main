<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Brand;
use App\Models\Picture;
use App\Models\Product;
use App\Models\Scopes\AccountScope;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    public function simulate($account_slug, Request $request){
        
        $account = Account::where('slug', $account_slug)->first();
        if(!$account){
            abort(404); 
        }
        
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

        $types = Type::withoutGlobalScopes()->where('account_id', $account->id)->get();
        $brands = Brand::withoutGlobalScopes()->where('account_id', $account->id)->get();

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
                
                // $brands = Brand::withoutGlobalScopes() // Désactiver les scopes globaux
                //     ->whereHas('products', function($query) use ($typeId, $account) {
                //     $query->where('type_id', $typeId)
                //           ->where('account_id', $account->id); // Appliquer le filtre `account_id`
                // })
                $brands = Brand::withoutGlobalScopes()->select('brands.*')
                    ->join('products', 'brands.id', '=', 'products.brand_id')
                    ->where('products.type_id', $typeId)
                    ->where('products.account_id', $account->id)
                ->distinct()
                ->get();
            }

            if($typeId && $brandId){
                // $product = Product::withoutGlobalScopes()
                //     ->where('type_id', $typeId)
                //     ->where('brand_id', $brandId)
                //     ->where('account_id', $account->id)
                //     ->first();
                $currentProducts = DB::table('products')
                    ->join('product_states', 'products.id', '=', 'product_states.product_id')
                    ->join('states', 'product_states.state_id', '=', 'states.id')
                    ->join('types', 'products.type_id', '=', 'types.id')
                    ->join('brands', 'products.brand_id', '=', 'brands.id')
                    ->where('types.id', $typeId)
                    ->where('brands.id', $brandId)
                    ->where('products.account_id', $account->id)  // Filtrer par account_id
                    ->distinct()
                    ->select(
                        'products.*', 
                        'states.name as state_name',
                        'types.name as type_name',
                        'brands.name as brand_name'
                    )
                ->get();

                if($currentProducts){
                    /* Reconstruire le produit */
                    if($stateId){
                        $product = new Product();
                        $productId = '';
                        foreach($currentProducts as $currentProduct){
                            $product->id = $currentProduct->id;
                        }
                        $product->type = Type::withoutGlobalScopes()->where('id', $typeId)
                            ->where('account_id', $account->id)
                            ->first();
                        $product->brand = Brand::withoutGlobalScopes()->where('id', $brandId)
                            ->where('account_id', $account->id)
                            ->first();
                        
                        $states = DB::table('product_states')
                            ->join('products', 'products.id', '=', 'product_states.product_id')
                            ->join('states', 'states.id', '=', 'product_states.state_id')
                            ->where('products.id', $product->id)
                            ->where('products.account_id', $account->id)
                            ->distinct()
                            ->get();
                        //$selectedState = $states->firstWhere('id', $stateId);
                    
                        foreach($states as $state){
                           if($state->state_id == $stateId){
                                $product->states = $state;
                                $selectedState = $state;
                                break;
                           }
                        }
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