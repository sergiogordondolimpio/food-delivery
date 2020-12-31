@extends('layouts/app')

@section('content')

<div class="container">

    <div class="row mt-5">
        <div class="col-md-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-primary badge-pill">{{$items}}</span>
            </h4>
            <ul class="list-group mb-3">
            @foreach ($cartItems as $cartItem)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                    <h6 class="my-0">{{$products[$cartItem->product_id]->title}}</h6>
                    <small class="text-muted">{{Str::limit($products[$cartItem->product_id]->description, 20)}}</small><br>
                    <small class="text-muted">$ {{$products[$cartItem->product_id]->price}}</small>
                    </div>
                    <span class="text-muted">items: {{$cartItem->quantity}}</span>
                    <span class="text-muted">{{$products[$cartItem->product_id]->price*$cartItem->quantity}}</span>
                </li>
            @endforeach
            
            
            <li class="list-group-item d-flex justify-content-between">
                <span>Total</span>
                <strong>$ {{$amount}}</strong>
            </li>
            </ul>
        </div>

        <div class="col-md-4">
            <div class="card p-2 d-flex justify-content-end">
                <div class="alert alert-primary" role="alert">
                    Checkout Completed! <br>
                    Please fill all the data of your PROFILE, especially phone number <br>
                    Our represant will be in contact with you. Thanks!
                </div>
                <a class="d-flex justify-content-end" href="/"><button type="button" class="btn btn-primary"> HOME </button></a>
            </div>
        </div>
        
    </div>
</div>
    

@endsection
