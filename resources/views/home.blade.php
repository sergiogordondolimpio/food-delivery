@extends('layouts.app')

@section('content')

    @include('/components/banner')
    
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="row justify-content-center">
                @foreach ($products as $product)
                <div class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center mt-5">
                    <div class="card" style="min-width: 300px;">
                        <img class="card-img-top" style="width: 100%;" src='{{asset("storage/docs/$product->file")}}' alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title">{{$product->title}}</h2>
                            <p class="card-text">{{$product->description}}</p>
                            <p class="font-weight-bold text-right h4">{{$product->price}}</p>
                            <a href="/cart/{{$product->id}}" class="btn btn-primary btn-sm">Add cart</a>
                        </div>
                    </div>
                </div>  
                @endforeach
            </div>
        </div>
    </div>

@endsection
