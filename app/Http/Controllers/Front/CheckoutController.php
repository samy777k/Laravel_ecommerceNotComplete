<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;
use App\Models\Order;
use App\Models\User;
use App\Models\FinishOrder;
use App\Repositories\Cart\CartModelRepository;
use App\Notifications\OrderCreatedNotification;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Countries::getNames('ar');
        $product_info = new CartModelRepository;
        return view('front.checkout')->with('countries' , $countries)->with('product' , $product_info);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $repository = new CartModelRepository;
        $attemptOrder = $repository->get();



          $order = Order::create( $request->all());

           foreach($attemptOrder as $item){
               FinishOrder::create([
           'order_id' => $order->id,
           'product_name' => $item->product->name,
           'store_name' => $item->product->store->name,
           'store_id' => $item->product->store->id,
           'category' => $item->product->category->name,
           'quantity' => $item->quantity
               ]);

        }
        //   $repository->empty();
        // $getOrder = Order::where('id' , $order->id)->get();
        // dd($getOrder);
        ////////////////////////////////////

        // dd($o->finishOrders[0]->store_id);

        ////////////////////////////////////
        $store = FinishOrder::where('order_id' , $order->id)->first();
        $user = User::where('store_id' , $store->store_id)->first();
        // dd($user);
        $user->notify(new OrderCreatedNotification($order));
        event('order.created');

         return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
