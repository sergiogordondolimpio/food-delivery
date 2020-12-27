<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Validator;

class ProductsController extends Controller
{


    /**
     *  the first charge website with no previews
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(){
        $data = [
            'title' => '',
            'description' => '',
            'price' => '',
            'titlePreview' => 'Card Title',
            'descriptionPreview' => "Some quick example text to build on the card title and make up the bulk of the card's content.",
            'pricePreview' => '$ 1.10',
            'imagePreview' => 'storage/docs/food-image1.PNG',
            'id' => ''
            ];
        
        return view('/products/addProduct', $data);
    }

    /**
     * Depend of the button clicked in the form is the response,
     * selected with a switch case
     * - store product
     * - show preview form
     * - update product
     *
     * @param Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        // depend of the button is the case
        switch($request->submitButton){

            // add element to the database
            case 'add':
                $validator = Validator::make($request->all(), [
                    'title' => 'required|unique:products|max:100',
                    'description' => 'required',
                    'price' => 'required|numeric'
                ],[
                    'unique' => 'The :attribute has already been taken. Please click UPDATE if you want to update it'
                ]
                );

                $data = $this->preview($request);
                if ($validator->fails()) {
                    // assign the id in the $data to update the product
                    // if the title exist
                    if ($validator->errors()->first('title') == "The title has already been taken. Please click UPDATE if you want to update it"){
                        $product = $this->search($request->title);
                        $data['id'] = $product[0]->id;
                    }
                    return view('/products/addProduct', $data)
                                ->withErrors($validator);
                    }
                
                $this->store($data);
                return redirect('/listProducts');
            break;

            // only return the preview
            case 'preview':
                $data = $this->preview($request);
                return view('/products/addProduct', $data);
            break;

            // update to the database
            case 'update':
                $validator = Validator::make($request->all(), [
                    'title' => 'required|max:100',
                    'description' => 'required',
                    'price' => 'required|numeric'
                    ]);
                    
                $data = $this->preview($request);

                // if the title of product doesn't exist, because the user
                // change it 
                if ($this->search($data['title'])->isEmpty()){
                    $data['id'] = 'error';
                    return view('/products/addProduct', $data);
                }

                if ($validator->fails()) {
                    return view('/products/addProduct', $data)
                    ->withErrors($validator);
                }
                    
                $this->update($data);
                return redirect('/listProducts');
            break;
        }

    }

    
    /**
     * Show the product in the view addProduct.
     * 
     * @param String $id
     * @return \Illuminate\Http\Response
     */
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
            'imagePreview' => "storage/docs/{$product[0]->file}",
            'id' => $id
            ];
        
        return view('/products/addProduct', $data);
        
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  Array  $request
     */
    public function update($request)
    {
        //dd($request);
        DB::table('products')
            ->where('title', $request['title'])
            ->update([
                'title' => $request['title'], 
                'description' => $request['description'],
                'price' => $request['price'],
                'file' => substr($request['imagePreview'], strrpos($request['imagePreview'], '/') + 1),
                ]
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $data
     */
    public function store($data)
    {
        $product = new Product;
        $product->title = $data['title'];
        $product->description = $data['description'];
        $product->price = $data['price']; 
        $product->file = substr($data['imagePreview'], strrpos($data['imagePreview'], '/') + 1);
        $product->save();
    }


    /**
     * Take the request and change the values depend of the input
     * to return an array with the new values to save or show in
     * the preview model and store the image, if there is, in the
     * storage
     * 
     * @param Object $request
     * @return Array $data
     */
    public function preview($request){

        $data = [];
        
        // the variable to the preview card in addProduct.blade is
        // update depend if the input of the form has something. 
        // If the input has something update the variable preview
        // for this, in other case, keep the same value
        ($request->title)?$data += ['titlePreview' => $request->title]:$data += ['titlePreview' => $request->titlePreview];
        ($request->description)?$data += ['descriptionPreview' => $request->description]:$data += ['descriptionPreview' => $request->descriptionPreview];
        ($request->price)?$data += ['pricePreview' => $request->price]:$data += ['pricePreview' => $request->pricePreview];
        
        // if the input file has some file, that file is storaged
        // and update the path
        if ($request->file('image')){
            $path = $request->file('image')->getClientOriginalName();
            $data += ['imagePreview' => "storage/docs/{$path}"]; 
            $request->image->storeAs('public/docs', $path);
        }else{
            $data += ['imagePreview' => $request->imagePreview];  
        }
       
        $data += ['title' => $request->title];
        $data += ['description' => $request->description];
        $data += ['price' => $request->price];
        $data += ['id' => $request->id];

        return $data;
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


     /**
     * Display a listing of the resource in the Home.
     *
     * @return \Illuminate\Http\Response
     */
    public function listHome()
    {
        $products = DB::table('products')->get();
        return view('home', ['products' => $products]);
    }


    /**
     * search in database fot title
     *
     * @param  String  $title
     * @return Product 
     */
    public function search($title)
    {
        return DB::table('products')
                    ->where('title', '=', $title)
                    ->get();
    }

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  String  $id
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
