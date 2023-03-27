<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderCreatedNotification extends Notification
{
    use Queueable;
    public $order ;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail' , 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from("SamyAdmin@laravel.com" , 'e_Commerce')
                    ->greeting("Hello {$this->order->finishOrders[0]->store_name}")
                    ->line("You have a purchase order {$this->order->finishOrders[0]->product_name} From
                    {$this->order->first_name} {$this->order->last_name}
                    ")
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable){


        return [
            'body' =>  "Hello {$this->order->finishOrders[0]->store_name} You have a purchase order {$this->order->finishOrders[0]->product_name}",
            'logo' => 'fas fa-envelope mr-2',
            'action' => url('/dashboard')
        ];

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
