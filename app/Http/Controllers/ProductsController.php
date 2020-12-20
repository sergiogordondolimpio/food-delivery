<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class ProductsController extends Controller
{
    
    /**
     * Display a listing of the resource in the listProduct.
     * In this list it can be edit or delete a card
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //
        $products = DB::table('products')->get();
        //echo $products;

        return view('Products/listProducts', ['products' => $products]);
    }


    /**
     * Show the preview, upload the image in the storage public
     */
    public function storeOnlyForPreview(Request $request){
        
        $data = [
            'title' => '',
            'description' => '',
            'price' => '',
            'file' => '',
            'titlePreview' => '',
            'descriptionPreview' => '',
            'pricePreview' => '',
            'filePreview' => '',
            'reload' => 'true'
            ];

        //dd(nl2br($request->description));
        if ($request['title']){
            $data['titlePreview'] = $request->title; 
            $data['title'] = $request->title; 
        }
        if ($request['description']){
            $data['descriptionPreview'] = $request->description;  
            $data['description'] = nl2br($request->description);  
        }
        if ($request['price']){
            $data['pricePreview'] = "$ {$request->price}"; 
            $data['price'] = $request->price; 
        }
       
        // if there is a image to upload we receive the string
        // storageImage and we recover the name of the file
        // and storage it. In the other way only need the path
        // of the storage
        if ($request->file == 'storageImage'){
            $path = $request->file('image')->getClientOriginalName();
            $data['filePreview'] = "storage/docs/{$path}"; 
            $request->image->storeAs('public/docs', $path);
        }else{
            $data['filePreview'] = "storage/docs/{$request->file}";  
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
        $validated = $request->validate([
            'title' => 'required|unique:products|max:100',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

       
        $file = new Product;
        $file->title = $request->title;
        $file->description = $request->description;
        $file->price = $request->price;
        if ($request->image){
            if ($request->file('image')->isValid()) {
                $path = $request->file('image')->getClientOriginalName();
                $request->image->storeAs('public/docs', $path);
                $file->file = $path;
            }
        }else{
            $file->file = $request->file;
        }
        $file->save();

        return redirect('/listProducts');
    }

    public function toUpdate($id)
    {
        $product = new Product;
        $product = DB::table('products')
            ->where('id', $id)
            ->get();

        $data = [
            'title' => $product[0]->title,
            'description' => $product[0]->description,
            'price' => $product[0]->price,
            'file' => $product[0]->file,
            'titlePreview' => $product[0]->title,
            'descriptionPreview' => $product[0]->description,
            'pricePreview' => "$ {$product[0]->price}",
            'filePreview' => "storage/docs/{$product[0]->file}",
            'reload' => 'true'
            ];
        
        return view('/products/addProduct', $data);
        
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
       
        if ($request->image){
            if ($request->file('image')->isValid()) {
                $path = $request->file('image')->getClientOriginalName();
                $request->image->storeAs('public/docs', $path);
                $file = $path;
            }
        }else{
            $file = $request->file;
        }

        //dd($request);
        DB::table('products')
            ->where('title', $request->title)
            ->update([
                'title' => $request->title, 
                'description' => $request->description,
                'price' => $request->price,
                'file' => $file,
                ]
            );

        return redirect('/listProducts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);
        $product-> delete();
        return redirect('listProducts');
    }
}
