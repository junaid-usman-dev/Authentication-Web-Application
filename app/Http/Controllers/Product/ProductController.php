<?php

namespace App\Http\Controllers\Product;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all(); // Get all proudcts list
        // dd($products);
        // print_r("Index");
        return view('c2c/index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create-product');
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
        // $request->validate([
        //     'title' => 'required',
        //     'short-description' => 'required',
        //     'long-description' => 'nullable',
        //     'category' => 'nullable',
        //     'squ' => 'nullable',
        //     'type' => 'nullable',
        //     'price' => 'nullable',
        //     'sale-price' => 'nullable',
        //     'discount-percentage' => 'nullable',
        //     'brand' => 'nullable',
        //     // 'picture' => 'image|mimes:jpeg,png,jpg|max:2048'
        //     'picture' => 'nullable',
        //     'available' => 'nullable',
        // ]);

        $title = $request->input('title');
        $short_description = $request->input('short-description');
        $long_description = $request->input('long-description');
        $category = $request->input('category');
        $squ = $request->input('squ');
        $type = $request->input('type');
        $price = $request->input('price');
        $sale_priceeee = $request->input('sale-price');
        $discount_percentage = $request->input('discount-percentage');
        $brand = $request->input('brand');
        $picture = $request->file('picture');
        $available = $request->input('available');

        
        error_log('++++++++++++++++++++++++++++++++++++++++++++');
        // Calculating sale price
        $cal_sale_price = ($discount_percentage/100)*$price;
        error_log("+++++++++++++++++ Cal Price ++++++++++++".$cal_sale_price);
        $sale_price_in_decimal = $price-$cal_sale_price;
        error_log("+++++++++++++++++ Sale ++++++++++++".$sale_priceeee);
        $sale_price = intval($sale_price_in_decimal); // converting into integer
        error_log("+++++++++++++++++ Sale Price ++++++++++++".$sale_price);
        

        $product = new Product();
        $product->title = $title;
        $product->short_description = $short_description;
        $product->long_description = $long_description;
        $product->category = $category;
        $product->squ = $squ;
        $product->type = $type;
        $product->price = $price;
        $product->sale_price = $sale_price;
        $product->discount_percentage =  $discount_percentage;
        $product->brand = $brand;
        
        $file_name = $picture->getClientOriginalName();
        $file_path = $picture->move('storage/product',$file_name);
        $product->picture = $file_path;

        $product->available = $available;
        
        $product->save();

        return redirect ('/');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $available)
    {
        //
        $products = Product::where('available',$available)->get();
        // dd($products);
        return view('c2c/index-1',['products'=>$products]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        $product = Product::where('id',$id)->first();
        // dd($product);
        return view('edit-product',['product'=>$product,'id'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        // $request->validate([
        //     'title' => 'required',
        //     'short-description' => 'required',
        //     'long-description' => 'nullable',
        //     'category' => 'nullable',
        //     'squ' => 'nullable',
        //     'type' => 'nullable',
        //     'price' => 'nullable',
        //     'sale-price' => 'nullable',
        //     'discount-percentage' => 'nullable',
        //     'brand' => 'nullable',
        //     // 'picture' => 'image|mimes:jpeg,png,jpg|max:2048'
        //     'picture' => 'nullable',
        //     'available' => 'nullable',
        // ]);

        $title = $request->input('title');
        $short_description = $request->input('short-description');
        $long_description = $request->input('long-description');
        $category = $request->input('category');
        $squ = $request->input('squ');
        $type = $request->input('type');
        $price = $request->input('price');
        $sale_priceee = $request->input('sale-price');
        $discount_percentage = $request->input('discount-percentage');
        $brand = $request->input('brand');
        $picture = $request->file('picture');
        $id = $request->input('id');

        // Calculating sale price
        $cal_sale_price = ($discount_percentage/100)*$price;
        $sale_price_in_decimal = $price-$cal_sale_price;
        $sale_price = intval($sale_price_in_decimal); // converting into integer
        
        $product = Product::where('id',$id)->first();
        $product->title = $title;
        $product->short_description = $short_description;
        $product->long_description = $long_description;
        $product->category = $category;
        $product->squ = $squ;
        $product->type = $type;
        $product->price = $price;
        $product->sale_price = $sale_price;
        $product->discount_percentage =  $discount_percentage;
        $product->brand = $brand;
        
        $file_name = $picture->getClientOriginalName();
        $file_path = $picture->move('storage/product',$file_name);
        $product->picture = $file_path;
        
        $product->save();

        return redirect ('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id )
    {
        //
        $proudct_id = Product::where('id',$id)->delete();
        // print_r("Destroy");
        $this->index();
        // return ("Deleted");
    }
}
