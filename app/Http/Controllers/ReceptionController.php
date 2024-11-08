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
        $products = Product::all();

        if(session('brand_id') && session('type_id')){
            $product = Product::where('type_id', session('type_id'))
                ->where('brand_id', session('brand_id'))
                ->first();

                if($product){
                    $states = $product->states()->get();
                }
        }

        if($request->isMethod('post')){
            // Cas du post de data 
            if($request->has('type_id')){
                session(['type_id' => $request->input('type_id')]);
            }
            if($request->has('brand_id')){
                session(['brand_id' => $request->input('brand_id')]);
            }
            // Validation, Controle
            // Creation d'un panier ou retour en arrière 
            return redirect()->route('reception.add.product');
        }
        return view('reception.products.product', [
            'types' => $types,
            'brands' => $brands,
            'product' => $product,
            'states' => $states 
        ]);
    }

    public function storeProduct()
    {

    }
    
}