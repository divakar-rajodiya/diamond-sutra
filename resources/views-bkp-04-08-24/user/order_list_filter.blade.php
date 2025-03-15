<table class="wishlist-table w-100">
    <thead>
        <tr>
            <th style="text-align:center;">#Order Id</th>
            <th style="text-align:center;">Product Image</th>
            <th style="text-align:center;">Product name</th>
            <th style="text-align:right;">Price</th>
            <th style="text-align:center;">Ordered Status</th>
            <th style="text-align:center;">Ordered Date</th>
            <th style="text-align:center;">More Details</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $order)
        <tr>
            <td class="remove-product" style="text-align:center;">
                #{{$order['order_id']}}
            </td>
            <td class="product-thumbnail" style="text-align:center;">
                <img src="{{url('public/assets/img/product/').'/'.$order['product_sku'].'/'.$order['product_sku'].'_'.config('constant.COLOR_CODE.'.$order['product_color']).'1.jpg'}}" class="img-fluid" alt="" />
            </td>
            <td class="product-name" style="text-align:center;">{{$order['product_sku']}}</td>
            <td class="product-price" style="text-align:right;">{{\General::currency_format($order['product_final_amount'])}}</td>
            <td class="stock-status text-success" style="text-align:center;"><b>{{config('constant.ORDER_STATUS.'.$order['order_status'])}}</b></td>
            <td class="product-name" style="text-align:center;">{{ date('d-m-Y H:i:s',strtotime($order['created_at']))}}</td>
            <td class="add-cart" style="text-align:center;">
                <a href="{{url('user/order-detail').'/'.$order['order_id']}}" class="add-cart-btn">More Details</a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>