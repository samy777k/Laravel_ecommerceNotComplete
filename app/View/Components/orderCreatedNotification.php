<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Auth;

class orderCreatedNotification extends Component
{

    public $countNotifications;
    public $notifications;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $user = Auth::user();
        $this->countNotifications = $user->notifications()->count();
        $this->notifications = $user->notifications()->take(5)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.order-created-notification');
    }
}
