<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Services\Contracts\PaymentGatewayInterface;
use PaymentGateway;
use App\Product;
use App\Order;
use App\OrderProduct;
use App\Cart;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('home', ['products' => $products]);
    }

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
