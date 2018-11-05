<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderProduct;
use Auth;

class OrderController extends Controller
{
    public function orders(){
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('orders', ['orders' => $orders]);
    }

    public function order($order_id){
        $order = Order::where('id',$order_id)->first();
        $order_products = OrderProduct::where('order_id',$order_id)
                            ->join('products','products.id','product_id')
                            ->get();
        return view('order', ['order' => $order,'order_products' => $order_products]);
    }
}
