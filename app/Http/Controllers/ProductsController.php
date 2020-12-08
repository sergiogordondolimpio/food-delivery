<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function storeOnlyForPreview(Request $request){
        $data = [
            'titlePreview' => '',
            'descriptionPreview' => '',
            'pricePreview' => '',
            'filePreview' => '',
            ];
    
        //$path = $request->file('file')->getClientOriginalName();
        if ($request['title']){
            $data['titlePreview'] = $request->title; 
            //$data['title'] = $request['title']; 
           
        }
        if ($request['description']){
            $data['descriptionPreview'] = $request->description; 
            dd($data['descriptionPreview']); 
            //$data['description'] = $request['description']; 
        }
        if ($request['price']){
            $data['pricePreview'] = "$ {$request->price}"; 
        }
        if ($path){
            $data['filePreview'] = "storage/docs/{$path}";  
            //dd($data['pricePreview']);
            $request->file->storeAs('public/docs', $path);
        }
        
    
        return view('/products/addProduct', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $file = Product::class;
        $file->title = $request->title;
        $file->description = $request->description;
        $file->price = $request->price;
        if ($request->file('file')->isValid()) {
            $path = $request->file('file')->getClientOriginalName();
            $request->file->storeAs('file', "docs/$path");
            $file->file = $request->file('file')->getClientOriginalName();
        }
        $file->save();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
