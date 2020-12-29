<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartsController extends Controller
{
    //

    public function show(){

        /*
            to add:
            $user = Post::find(value);
            $cart = new Cart;
            $user->carts()save($cart);
        */

        dd('hola');
        return view('cart/cart');
    }

    /**
     *  Function to save the item added to the cart of 
     *  the user
     * 
     *  @param  \Illuminate\Http\Request $request
     * 
     *  @return \Illuminate\Http\Response
     */
    public function storeItem(Request $request, $id)
    {
        // find the user
        $user = User::find(Auth::user()->id);
        
        // find product
        $product = Product::find($id);
         
        
        // find the last cart of the user, with the function cart()
        // in User, is associated with hasmany, so is a collection
        // using last() to get the last element of the collection
        $cart = (User::find(Auth::user()->id)->carts)->last();
                
        // substract 15 days of today with Carbon
        $twoWeeksAgo = now()->subDays(15)->toDateTimeString();
        // if the user has not cart without checkout or
        // before the last two weeks, create a cart and save in DB
        if (!$cart || $cart->created_at->toDateTimeString() < $twoWeeksAgo){
            $newCart = new Cart;
            $newCart->user_id = $user->id;
            $newCart->checkout = false;
            $user->carts()->save($newCart);
            $cart = $newCart;
        }

        // find all the cartItems of the cart
        $cartItems = Cart::find($cart->id)->cart_items;
        
        // validate if is the cartItems empty
        if (!$cartItems->isEmpty()){
            $cartItem = CartItem::where('product_id', $product->id)->first();
            // if the product has been added, add 1 to the quantity value
            if ($cartItem){
                $cartItem->quantity++;
            }else{
                $cartItem = new CartItem;
                $cartItem->cart_id = $cart->id;
                $cartItem->product_id = $product->id;
                $cartItem->quantity = 1;
                $cartItem->price = $product->price;
            }
        }else{
            $cartItem = new CartItem;
            $cartItem->cart_id = $cart->id;
            $cartItem->product_id = $product->id;
            $cartItem->quantity = 1;
            $cartItem->price = $product->price;
        }
        // create the item
        $cart->cart_items()->save($cartItem);
        dd('save');

    }


    
}
