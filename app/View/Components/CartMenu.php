<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Repositories\Cart\CartModelRepository;

class CartMenu extends Component
{
    public $carts;
    public $count;
    public $total;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $repository = new CartModelRepository;
        $this->carts = $repository->get();
        $this->count = $repository->count();
        $this->total = $repository->total();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-menu');
    }
}
