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

    /**
     *  Show the cartItems and the products of the client
     *  in the view /cart
     *  
     *  @return Illuminate\Http\Response
     */
    public function show(){

        // find last cart of the client
        $cart = (User::find(Auth::user()->id)->carts)->last();

        // substract 15 days of today with Carbon
        $twoWeeksAgo = now()->subDays(15)->toDateTimeString();
        
        // if there is a cart or the cart is not before two weeks
        if ($cart || $cart->created_at->toDateTimeString() > $twoWeeksAgo){
            $cartItems = Cart::find($cart->id)->cart_items;
        }

        $products = Product::all()->keyBy('id');

        //dd($cartItems);

        return view('cart/cart', [
            'cartItems' => $cartItems,
            'products' => $products
        ]);
    }

    /**
     *  Count the items of the client for the last two weeks
     *  add in the cart
     *  
     *  @return Integer
     */
    public static function countItems()
    {
        // check if someone is logged
        if (Auth::check()){

            // find last cart of the client
            $cart = (User::find(Auth::user()->id)->carts)->last();
            
            // substract 15 days of today with Carbon
            $twoWeeksAgo = now()->subDays(15)->toDateTimeString();
            
            // if there is a cart or the cart is not before two weeks
            if ($cart || $cart->created_at->toDateTimeString() > $twoWeeksAgo){
                $count = 0;
                $cartItems = Cart::find($cart->id)->cart_items;
                foreach ($cartItems as $cartItem){
                    $count += $cartItem->quantity;
                }
                return $count;
            }
        }
        return 0;
    }


    /**
     *  Count the total to pay, amount
     *  
     *  @return Float
     */
    public static function amount()
    {
        // check if someone is logged
        if (Auth::check()){

            // find last cart of the client
            $cart = (User::find(Auth::user()->id)->carts)->last();
            
            // substract 15 days of today with Carbon
            $twoWeeksAgo = now()->subDays(15)->toDateTimeString();
            
            // if there is a cart or the cart is not before two weeks
            if ($cart || $cart->created_at->toDateTimeString() > $twoWeeksAgo){
                $amount = 0;
                $cartItems = Cart::find($cart->id)->cart_items;
                foreach ($cartItems as $cartItem){
                    // find the product belongsTo the cartItem
                    $product = CartItem::find($cartItem->id)->product;
                    // add the product of the number of products in the 
                    // cartItems plus the price of the product
                    $amount += $cartItem->quantity*$product->price;
                }
                return $amount;
            }
        }
        return 0;
    }


    /**
     *  Function to delete a CartItem
     * 
     *  @param App\Models\CartItem $id
     * 
     *  @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cartItem = CartItem::find($id);

        $cartItem->delete();

        return redirect('/cart');
    }


     /**
     *  Function to checkout
     * 
     *  @param App\Models\CartItem $id
     * 
     *  @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        
        dd($request);
        return $request;
    }



    /**
     *  Function to save the item added to the cart of 
     *  the user
     * 
     *  @param \Illuminate\Http\Request $request
     *  @param App\Models\Product $id
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
        
        return redirect('/');
    }


    
}
