<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Auth;

class CartController extends Controller
{
    public function addToCart($product_id){
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        foreach ($cart as $cart_data) {
            if($cart_data->product_id == $product_id){
                return redirect('/cart')->with('status', 'Product is Already Added to Cart');
            }
        }

        $cart = new Cart;
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $product_id;
        $cart->quantity = 1;
        $cart->save();

        return redirect('/cart');
    }

    public function cart(){
        $products = Cart::where('user_id',Auth::user()->id)
                        ->join('products','products.id','product_id')
                        ->get();
        return view('cart', ['products' => $products]);
    }
}
