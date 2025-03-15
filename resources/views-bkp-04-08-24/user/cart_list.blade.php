<a href="#" id="cartDropdown" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-basket-shopping"></i>(0)</a>
<ul class="cart-menu" aria-labelledby="cartDropdown">
    <!-- if cart was empty add class -> cart-empty -->
    @if(empty($data))
    <li class="cart-item-empty m-0">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg')}}" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
        </span>
        <p>No products in the cart.</p>
    </li>
    @else
    @foreach($data as $item)
    <li class="d-flex align-items-center gap-3">
        <div class="feature-image light-bg">
            <a href="{{url('product/detail/').'/'.$item['product_sku']}}"><img src="{{url('public/assets/img/product/').'/'.$item['product_sku'].'/'.$item['product_sku'].'_'.$item['color_code'].'1.jpg'}}" alt="feature image" class="img-fluid"></a>
        </div>
        <div class="d-flex justify-content-between gap-3 w-100">
            <div>
                <a href="product-details.html">
                    <h6 class="mb-1 text-dark">Weeding Rings</h6>
                </a>
                <span class="price d-block mb-1 fs-sm">{{\General::currency_format($item[product_price'])}}</span>
                <p class="quantity">{{$item['quantity']}}</p>
            </div>
            <div>
                <a href="javascript:void(0)" class="close text-dark"><i class="fas fa-xmark"></i></a>
            </div>
        </div>
    </li>
    <li class="subtotal-title-area" style="display: block;">
        <div class="subtotal-info">
            <div class="subtotal-titles">
                <h3>Sub Total:</h3>
                <span id="cart-total" class="subtotal-price">£27.00</span>
            </div>
        </div>
        <div class="mini-cart-btns">
            <div class="cart-btns">
                <a href="/cart" class="btn btn-outline-dark w-100">View Cart</a>
                <a href="/checkout" class="btn btn-outline-dark w-100">Checkout</a>
            </div>
        </div>
    </li>
    @endif
</ul>