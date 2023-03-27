<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function create(){
        $products = Product::with('category')->where('status' , 'active')->latest()->take(8)->get();
        return view('front.home' , compact('products'));
    }
}
