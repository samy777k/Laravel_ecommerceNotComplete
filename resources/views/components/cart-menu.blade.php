<div class="cart-items">
    <a href="javascript:void(0)" class="main-btn">
        <i class="lni lni-cart"></i>
        <span class="total-items">{{$count}}</span>
    </a>
    <!-- Shopping Item -->
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{$count}} Items</span>
            <a href="cart.html">View Cart</a>
        </div>
        <ul class="shopping-list">
            @foreach ($carts as $item)


            <li>
                <a href="javascript:void(0)" class="remove"
                    title="Remove this item"><i class="lni lni-close"></i></a>
                <div class="cart-img-head">
                    <a class="cart-img" href="product-details.html"><img
                            src="{{$item->product->image_url}}"
                            alt="#"></a>
                </div>

                <div class="content">
                    <h4><a href="product-details.html">
                            {{$item->product->name}}</a></h4>
                    <p class="quantity"><span class="amount">{{$item->quantity}}</span> -${{$item->quantity * $item->product->price}}</p>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="bottom">
            <div class="total">
                <span>Total</span>
                <span class="total-amount">${{$total}}</span>
            </div>
            <div class="button">
                <a href="checkout.html" class="btn animate">Checkout</a>
            </div>
        </div>
    </div>
    <!--/ End Shopping Item -->
</div>
