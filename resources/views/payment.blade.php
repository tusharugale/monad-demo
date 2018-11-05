@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Payment</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-10">
                            Total Price of Order
                        </div>
                        <div class="col-md-2">
                            &#8377; {{$total_price}}/-                   
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <form action="/process-payment">
                                <button class="btn btn-success">Process Payment</button>
                            </form>                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
