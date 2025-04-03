<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    //
    public function index(){
        $products = DB::table('products')->select()->get();

        return view('products.index',["products"=>$products]);
     

    }
}
