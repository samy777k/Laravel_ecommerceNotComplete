<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\FinishOrder;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;

class SendOrderNotification
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
       
        // $event = new FinishOrder;
        // dd($event->store_id);
        // $store_id =
        // $user = User::where('store_id' , $event->store_id)->first();

        // $user->notify(new OrderCreatedNotification($event->order));
    }
}
