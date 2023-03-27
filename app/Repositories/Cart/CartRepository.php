<?php

namespace App\Repositories\Cart;
use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRepository{

    public function get() : collection;

    public function add(Product $product , $quentity = 1);

    public function update(Product $product , $quentity);

    public function delete(Product $product);

    public function empty();

    public function total();


}

?>
