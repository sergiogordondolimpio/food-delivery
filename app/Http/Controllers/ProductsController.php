<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    protected  $data = [
        'title' => '',
        'description' => '',
        'price' => '',
        'file' => '',
        'titlePreview' => '',
        'descriptionPreview' => '',
        'pricePreview' => '',
        'filePreview' => '',
        ];

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

    /**
     * Show the preview, upload the image in the storage public
     */
    public function storeOnlyForPreview(Request $request){
       
    
        //dd($request->file);
        if ($request['title']){
            $data['titlePreview'] = $request->title; 
            $data['title'] = $request->title; 
        }
        if ($request['description']){
            $data['descriptionPreview'] = $request->description;  
            $data['description'] = $request->description;  
        }
        if ($request['price']){
            $data['pricePreview'] = "$ {$request->price}"; 
            $data['price'] = $request->price; 
        }
        try{
            $path = $request->file('file')->getClientOriginalName();
            $data['filePreview'] = "storage/docs/{$path}";  
            //dd($data['pricePreview']);
            $request->file->storeAs('public/docs', $path);
        } catch(Exception $e){
            $data['filePreview'] = "storage/docs/{$request->file}";  
            //dd($data['pricePreview']);
            $request->file->storeAs('public/docs', $request->file);
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
        $file = new Product;
        $file->title = $request->title;
        $file->description = $request->description;
        $file->price = $request->price;
        if ($request->file('file')->isValid()) {
            $path = $request->file('file')->getClientOriginalName();
            $request->file->storeAs('public/docs', $path);
            $file->file = $path;
        }
        $file->save();

        return redirect('/');
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
