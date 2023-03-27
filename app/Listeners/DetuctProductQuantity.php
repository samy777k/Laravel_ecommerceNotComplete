<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\Cart\CartModelRepository;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DetuctProductQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle()
    {

        $repository = new CartModelRepository;
         $cart = $repository->get();
        foreach($cart as $item){
        Product::where('id' , $item->product_id)
            ->update([

                'quantity' => DB::raw("quantity - $item->quantity ")

            ]);
        }
    }
}
