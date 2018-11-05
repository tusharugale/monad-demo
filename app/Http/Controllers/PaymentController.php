<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PaymentGateway;
use App\Cart;
use App\Order;
use App\OrderProduct;
use Auth;

class PaymentController extends Controller
{
    public function index(){
    	$total_price = 0;
        $cart_products = Cart::where('user_id',Auth::user()->id)
                                ->join('products','products.id','product_id')
                                ->get();
        foreach ($cart_products as $cart_product) {
            $total_price += $cart_product->price;
        }
    	return view('payment', ['total_price' => $total_price]);
    }



    /**
     * Process Payment
     *
     * @return \Illuminate\Http\Response
     */
    public function processPayment()
    {
        $total_price = 0;
        $cart_products = Cart::where('user_id',Auth::user()->id)
                                ->join('products','products.id','product_id')
                                ->get();
        foreach ($cart_products as $cart_product) {
            $total_price += $cart_product->price;
        }

        //payamet data will be checked here.
        $validate = PaymentGateway::checkData();

        //if data is validated then payment will be processed
        //Which payment gateway to use will be decided from PaymentGatewayServiceProvider
        //Currently its Citrus.
        //This will help us to change payment gateway instantly whenever needed.
        if($validate){
            $payment = PaymentGateway::processPayment();
            if($payment){
                $order = new Order;
                $order->user_id = Auth::user()->id;
                $order->total_price = $total_price;
                $order->save();

                foreach ($cart_products as $cart_product) {
                    $order_product = new OrderProduct;
                    $order_product->order_id = $order->id;
                    $order_product->product_id = $cart_product->product_id;
                    $order_product->save();
                }
                Cart::where('user_id',Auth::user()->id)->delete();
            }else{
                return redirect('/cart')->with('status', 'Payment Failed. Please try again');
            }            
        }else{
            return redirect('/cart')->with('status', 'Payment Failed. Please try again');
        }

        return redirect('/home')->with('status', 'Order Placed Successfully');

    }
}
