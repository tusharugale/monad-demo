@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Order  # {{$order->id}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($order_products as $order_product)
                        
                        <div class="row">
                            <div class="col-md-2" style="float: left;">
                                {{$order_product->id}}
                            </div>
                             <div class="col-md-4" style="float: left;">
                                <img src="{{$order_product->image}}" style="width: 100px;height: 100px;">
                            </div>
                            <div class="col-md-4" style="float: left;">
                                 {{$order_product->name}}
                            </div>
                            <div class="col-md-2" style="float: left;">
                                 &#8377; {{$order_product->price}}
                            </div>
                        </div>
                        <br/>
                        <hr>
                        <br/>
                    @endforeach
                    <hr/>
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-1">Total : </div>
                        <div class="col-md-2">&#8377; {{$order->total_price}}/-                            
                        </div>
                    </div>
                    <br/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
