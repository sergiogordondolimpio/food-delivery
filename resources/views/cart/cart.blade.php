@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <div class="row">
            <div class="col-sm-6">
                <h2>My Cart</h2>
            </div>
            <div class="col-sm-6 d-flex flex-row-reverse align-items-center">
                <form action="/checkout" method="post">
                    @csrf
                    @foreach($cartItems as $cartItem)
                        <input type="hidden" id="cartItems[{{ $cartItem->id }}]" name="quantity[{{ $cartItem->id }}]" value="{{ $cartItem->quantity }}">
                    @endforeach
                    <button type="submit" class="btn btn-primary px-2 py-1">Pay</button>
                </form>
                <h6 class="mb-0 mr-4" id="amount">Amount: ${{ App\Http\Controllers\CartsController::amount() }}</h6>
                <h6 class="mb-0 mr-4" id="items">Items ({{ App\Http\Controllers\CartsController::countItems() }})</h6>
            </div>
        </div>
        <hr class="my-4">
    
        @foreach ($cartItems as $cartItem)
        
            <div class="card p-2 mt-3" style="width: 35rem;">
                <div class="row">
                    <div class="col-sm-3">                        
                        <img class="card-img-top" src="{{asset('storage/docs/'.$products[$cartItem->product_id]->file)}}" alt="Card image cap">
                    </div>
                    <div class="col-sm-6">                        
                        <h5 class="card-title">{{$products[$cartItem->product_id]->title}}</h5>
                        <p class="card-text">{{$products[$cartItem->product_id]->description}}</p>
                        <h5 class="pt-1">$ {{$products[$cartItem->product_id]->price}}</h5>  
                        <a href="/cart/delete/{{$cartItem->id}}" class="btn btn-primary px-2 py-1" >Delete</a>
                    </div>
                    <div class="col-sm-3 align-self-center">      
                        <div class="row align-items-center">
                            <button type="button" onclick="minus('{{$cartItem->id}}',{{$products[$cartItem->product_id]->price}})" class="btn btn-link p-2"><h5>-</h5></button>
                            <input type="text" id="{{$cartItem->id}}" class="form-control w-25 d-inline" value="{{$cartItem->quantity}}">
                            <button type="button" onclick="plus('{{$cartItem->id}}',{{$products[$cartItem->product_id]->price}})" class="btn btn-link p-2"><h5>+</h5></button>
                        </div>           
                    </div>
                </div>
            </div>
        
        @endforeach
            
    </div>

    <script>
        // set in the inner in the element the result of add or substract
        // the value of the input
        function plusMinusItem(number, sign){
            // get only the numbers
            var res = parseInt(number.replace(/\D/g, ""));
            // add or substract depend of the sign
            (sign == '-') ? res-- : res++
            // set in the inner of the element
            document.getElementById("items").innerText = "Items ("+ res +")";
            document.getElementById("nav-cart").innerText = res;
        }

        function plusMinusAmount(price, sign){
            // get an array splitting the string with $
            var res = document.getElementById("amount").innerText.split("$");
            number = parseFloat(res[1]);
            // add or substract depend of the sign
            (sign === '-') ? number = number - price : number = number + price
            // set in the inner of the element
            document.getElementById("amount").innerText = "Amount: $"+parseFloat(number).toFixed(2);
        }

        // add 1 to the input value and set in it
        function plus(id,price){
            document.getElementById(id).value++ 
            // add one to the hidden input in the form too
            document.getElementById("cartItems["+id+"]").value++ 
            plusMinusItem(document.getElementById("items").innerText, "+")
            plusMinusAmount(price, '+')
        } 

        // substract 1 to the input value and set in it
        function minus(id,price){
            // only if value is more than 0 can substract
            if (document.getElementById(id).value > 0){
                document.getElementById(id).value--
                document.getElementById("cartItems["+id+"]").value--
                plusMinusItem(document.getElementById("items").innerText, "-")
                plusMinusAmount(price, '-')
            }
        } 
    </script>

@endsection