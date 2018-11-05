@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Products</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($products as $product)
                        <div class="col-md-4" style="float: left;">
                            <figure class="card card-product">
                                <div class="img-wrap"><img src="{{$product->image}}" style="width: 220px;height: 220px;"></div>
                                <figcaption class="info-wrap">
                                        <h4 class="title">{{$product->name}}</h4>
                                        <p class="desc">{{$product->description}}</p>
                                        
                                </figcaption>
                                <div class="bottom-wrap">
                                    <a href="add-to-cart/{{$product->id}}" class="btn btn-sm btn-primary float-right">Add to Cart</a> 
                                    <div class="price-wrap h5">
                                        <span class="price-new">&#8377; {{$product->price}}/-</span>
                                    </div> <!-- price-wrap.// -->
                                </div> <!-- bottom-wrap.// -->
                            </figure>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
