@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
        
            @forelse ($products as $product)
                <div class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center mt-5">
                    <div class="card" style="min-width: 300px;">
                        <img class="card-img-top" style="width: 100%;" src="{{asset('storage/docs/'.$product->file)}}" alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title"> {{ $product->title }} </h2>
                            <p class="card-text"> {!! nl2br(e($product->description)) !!} </p>
                            <p class="font-weight-bold text-right h4"> {{ $product->price }} </p>
                            <a href={{"/edit/".$product->id }} class="btn btn-primary btn-sm">Edit</a>
                            <a href={{"/delete/".$product->id }} class="btn btn-primary btn-sm">Delete</a>
                        </div>
                    </div>
                </div>  
            @empty
                <div class="d-flex flex-column">
                    <div class="card-header mt-3">
                        <h2>There is no products</h2>
                    </div>
                    @include('products/cardExample')
                </div>
            @endforelse
            
        </div>
    </div>
    
@endsection
