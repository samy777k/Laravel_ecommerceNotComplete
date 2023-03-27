<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Cart\CartModelRepository;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //عملت هيك وبعتلو اوبجكت عشان اقدر استخدم الفنكشنز الجاهزة بالفيو
    public function index(CartModelRepository $carts)
    {
        // $repository = new CartModelRepository();
        // $carts = $repository->get();
        // dd($repository);
        return view('front.cart' , ['carts' => $carts]);
    }


    public function store(Request $request)
    {
        $product = Product::where('id' , $request->product_id)->first();

        $repository = new CartModelRepository();
        $repository->add($product , $request->quantity);
        // dd($request->quantity);
        return redirect()->route('carts.index')->with('success' , 'Added To Your Cart.......');
    }


    public function update(Request $request)
    {
        $product = Product::where('id' , $request->product_id);
        $repository = new CartModelRepository();
        $repository->update($product , $request->quantity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $repository = new CartModelRepository();
        $repository->delete($product);
         return redirect()->back();
    }
}
