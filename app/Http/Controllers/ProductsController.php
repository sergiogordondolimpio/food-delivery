<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Validator;

class ProductsController extends Controller
{

    public function index(Request $request){

        switch($request->submitButton){
            case 'add':
                dd($request->submitButton);
            break;
            case 'preview':
                dd($request->submitButton);
            break;
            case 'update':
                dd($request->submitButton);
            break;
        }

    }
    
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

    // list to use in an api
    public function listApi()
    {
        return Product::all();
    }

    // add in database with api
    public function add(Request $request)
    {
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->file = $request->file;
        $result = $product->save();
        if ($result){
            return ["Result" => "Data has been saved"];
        }else{
            return ["Result" => "Operation failed"];
        }
    }

    // delete in database with api
    public function delete($id)
    {
        $product = Product::find($id);
        $result = $product->delete();
        if ($result){
            return ["Result" => "Data has been deleted"];
        }else{
            return ["Result" => "Operation failed"];
        }
    }

    // search in database with api
    public function search($title)
    {
        return Product::where("title", $title)->get();
        
    }

    // save with validations using api
    public function testData(Request $request)
    {
        $rules = array(
            "title" => "required"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return $validator->errors();
        }else{
            $product = new Product;
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->file = $request->file;
            $result = $product->save();
        }
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
