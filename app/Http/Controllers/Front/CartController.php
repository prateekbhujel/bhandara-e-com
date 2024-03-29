<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(Request $request)
    {
        $cart = [];

        if($request->hasCookie('bhandara_ecom_cart')){
            $cart = json_decode($request->cookie('bhandara_ecom_cart'), true);
        }

        foreach($cart as $id => $item)
        {
            $product = Product::find($id);

            if(!is_null($product->discounted_price)){
                $price = $product->discounted_price;
            }else {
                $price = $product->price;
            }

            $cart[$id] = [
                'qty'       => $item,
                'name'      => $product->name,
                'thumbnail' => $product->thumbnail,
                'price' => $price,
                'total' => $price * $item,
            ];

            $cart = collect($cart);
        }

        return view('front.cart.index', compact('cart'));

    }//End Method

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

        return response(['success' => 'Product added to cart.'])->cookie('bhandara_ecom_cart', json_encode($cart), 30*60*60);

    }//End Method

    public function update(Request $request)
    {
        
        return to_route('front.cart.index')->with('success', 'Cart Updated.')->cookie('bhandara_ecom_cart', json_encode($request->qty), 30*60*60);

    }//End Method


    public function destroy(Request $request, $id)
    {
        $cart = json_decode($request->cookie('bhandara_ecom_cart'), true);
        unset($cart[$id]);

        if(!empty($cart)) {

            return to_route('front.cart.index')->with('success', 'Item Removed from cart.')->cookie('bhandara_ecom_cart', json_encode($cart), 30 * 60 * 60);

        } else {

            return to_route('front.cart.index')->with('success', 'Cart is empty.')->withoutCookie('bhandara_ecom_cart');

        }

    }//End Method


    public function total(Request $request)
    {
        $cart = [];

        if($request->hasCookie('bhandara_ecom_cart')){
            $cart = json_decode($request->cookie('bhandara_ecom_cart'), true);
        }

        $qty   = 0;
        $price = 0;

        foreach($cart as $id => $item) {
            $qty += $item;

            $product = Product::find($id); 

            if(!is_null($product->discounted_price)) {
                $price += $item * $product->discounted_price;
            }else {
                $price += $item * $product->price;
            }
        }
        $price = number_format($price);

        return response(compact('qty', 'price'));

    }//End Method

    public function checkout(Request $req)
    {
        $cart = json_decode($req->cookie('bhandara_ecom_cart'), true);

        $order = Order::create(['user_id' => Auth::id()]);

        foreach($cart as $id => $item)
        {
            $product = Product::findorFail($id);

            if(!is_null($product->discounted_price)) 
            {
                $price = $product->discounted_price;
                $total = $item * $price;

            } else 
            {
                $price = $product->price;
                $total = $item * $price;

            }

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'price' => $price,
                'qty' => $item,
                'total' => $total,
            ]);

        }//End Foreach

        return to_route('front.user.index')->with('success', 'Thank you for your order. It is currently is been processed.')->withoutCookie('bhandara_ecom_cart');

    }//End Method



}
