<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\DetuctProductQuantity;
use App\Listeners\EmptyCart;
use App\Listeners\SendOrderNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'order.created' => [
            //هان الترتيب مهم لانو هينقص الكونتتتي والكارت مليانة مش فاضية
            // DetuctProductQuantity::class,
            // SendOrderNotification::class
            // EmptyCart::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
