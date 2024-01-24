<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request, int $id, int $qty)
    {
        $cart = [];

        if($request->hasCookie('bhandara_ecom_cart')){
            $cart = json_decode($request->cookie('bhandara_ecom_cart'), true);
        }

        if(key_exists($id, $cart)) {
            $qty += $cart[$id];
        }

        $cart[$id] = $qty;

        return response(['success' => 'Product Added to cart.'])->cookie('bhandara_ecom_cart', json_encode($cart), 30*60*60);

    }//End Method
}
