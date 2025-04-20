<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use App\Models\Product;
class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        dd($products);
        
        return view('admin.products.index');
     
    }
    // public function show($id){
    //     $product = DB::table('products')->where('id', $id)->first();
    //     dd($product)->name;
    //     return view('products.show', ['product' => $product]);
    // }
    // public function create(){
    //     return view('admin.products.create');
    // }
    // public function store(Request $request){
    //     $product = new Product();
    //     $product->name = $request->input('name');
    //     $product->price = $request->input('price');
    //     $product->save();

    //     return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    // }
}
