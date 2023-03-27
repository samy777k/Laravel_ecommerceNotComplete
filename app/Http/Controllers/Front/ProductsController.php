<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function show($slug){
        $product = Product::where('slug' , $slug)->where('status' , 'active')->first();
        return view('front.details' , compact('product'));
    }
}
