<?php 

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class ReceptionController
{
    public function dashboard()
    {
        $user = session('subsession.user');
        $roleName = session('subsession.role_name');
        return view('reception.dashboard', ['user' => $user, 'role' => $roleName]);
    }

    public function addProduct(Request $request)
    {
        $account = $request->user();
        $types = Type::all();
        $brands = Brand::all();
        $product = '';
        $states = [];
        $selectedState = null;

        if($request->isMethod('post')){
            // Cas du post de data 
            $product = null;
            $states = [];
            $stateId = null;
            //dd($request->all());
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

            if($typeId && $brandId){
                $product = Product::where('type_id', $typeId)
                    ->where('brand_id', $brandId)
                    ->first();
                
                    if($product){
                        $states = $product->states()->get();
                    }

                    if($stateId){
                        $selectedState = $states->firstWhere('id', $stateId);
                    }
            }
            
            // Validation, Controle
            // Creation d'un panier ou retour en arrière 
            return view('reception.products.product', compact(
                'states',
                'product',
                'brands',
                'types',
                'selectedState',
            ));
        }
        return view('reception.products.product', [
            'types' => $types,
            'brands' => $brands,
            'product' => $product,
            'states' => $states,
            'selectedState' => $selectedState
        ]);
    }

    public function storeProduct()
    {

    }

    public function cancel()
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
        return redirect()->route('reception.dashboard');
    }
    
}