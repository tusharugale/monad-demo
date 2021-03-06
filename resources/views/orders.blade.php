@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Orders</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($orders as $order)
                        
                        <div class="row">
                            <div class="col-md-2" style="float: left;">
                                {{$order->id}}
                            </div>
                             <div class="col-md-4" style="float: left;">
                                {{$order->created_at}}
                            </div>
                            <div class="col-md-4" style="float: left;">
                                 &#8377; {{$order->total_price}}/-
                            </div>
                            <div class="col-md-2" style="float: left;">
                                <a href="/orders/{{$order->id}}" class="btn btn-success">View Order</a>
                            </div>
                        </div>
                        <br/>
                        <hr>
                        <br/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
