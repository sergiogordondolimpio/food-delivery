@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <h2>My Cart</h2>
        <hr class="my-4">
    
        @foreach ($cartItems as $cartItem)
        
            <div class="card p-1 mt-2" style="width: 35rem;">
                <div class="row">
                    <div class="col-sm-3">                        
                        <img class="card-img-top" src="{{asset('storage/docs/'.$products[$cartItem->product_id]->file)}}" alt="Card image cap">
                    </div>
                    <div class="col-sm-6">                        
                        <h5 class="card-title">{{$products[$cartItem->product_id]->title}}</h5>
                        <p class="card-text">{{$products[$cartItem->product_id]->description}}</p>
                        <h5 class="pt-1">$ {{$products[$cartItem->product_id]->price}}</h5>  
                        <a href="#" class="btn btn-primary p-2">Delete</a>
                    </div>
                    <div class="col-sm-3 align-self-center">      
                        <div class="row align-items-center">
                            <button type="button" class="btn btn-link p-2"><h5>-</h5></button>
                        <input type="text" value="{{$cartItem->quantity}}" class="form-control w-25 d-inline">
                            <button type="button" class="btn btn-link p-2"><h5>+</h5></button>                            
                        </div>           
                    </div>

                </div>
               
            </div>
        
        @endforeach

    </div>
@endsection