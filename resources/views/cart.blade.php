@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cart</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <?php
                    $total_price = 0;
                    ?>
                    @foreach($products as $product)
                        <?php
                            $total_price += $product->price; 
                        ?>
                        <div class="row">
                            <div class="col-md-2" style="float: left;">
                                <img src="{{$product->image}}" style="width: 100px;height: 100px;">
                            </div>
                            <div class="col-md-4" style="float: left;">
                                {{$product->name}}
                            </div>
                            <div class="col-md-4" style="float: left;">
                                {{$product->description}}
                            </div>
                            <div class="col-md-2" style="float: left;">
                                &#8377; {{$product->price}}
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
                        <div class="col-md-2">&#8377; {{$total_price}}                            
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <form action="/process-payment">
                                <button class="btn btn-success">Procceed to Payment</button>
                            </form>                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
