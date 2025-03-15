@extends('layouts.admin')

@section('header')


@stop
@section('content')

@php
$orderDetail = $body['orderDetail'];
@endphp

<style>
    .item-image-block .img-thumbnail {
        border: 0;
        width: 150px;
    }

    .item-price-info-block {
        text-align: right;
        font-weight: 600;
        font-size: 18px;

    }

    .item-attr-table {
        margin-bottom: 5px;
    }

    .item-attr-table tr td {
        font-size: 14px;
        padding: 5px 10px;
        font-weight: 600;
    }

    .item-attr-table tr:last-child td {
        border: 0;
    }

    .item-attr-table tr td:first-child {
        background-color: #f6f6f6;
    }

    .item-attr-table select {
        width: 50px;
        border: 0;
    }

    .item-attr-table select:hover {
        cursor: pointer;
    }

    .remove-item-btn {
        padding-left: 0px;
        font-weight: 500;
    }

    .item-button-block {
        display: flex;
        margin-top: 5px;
        margin-bottom: 5px;
        flex-wrap: wrap;
        justify-content: flex-start;
        column-gap: 20px;
        align-items: center;
    }

    select.order_status {
        width: 50%;
        padding: 10px 15px;
    }

    @media only screen and (max-width: 1024px) {
        .item-button-block {
            justify-content: center;
            align-items: center;
        }
    }

    @media only screen and (max-width: 768px) {
        .item-button-block {
            flex-direction: column;
            align-content: space-around;
        }

        .item-price-info-block {
            text-align: left;
            font-size: 16px;
        }

        select.order_status {
            width: 100%;
        }
    }

    .browse-chain-btn {
        border: 1px solid;
    }

    .browse-chain-btn:hover {
        background-color: #000;
        color: #fff;
    }

    .item-summary-block {
        display: flex;
        -webkit-box-pack: justify;
        padding-top: 7px;
        justify-content: space-between;
        padding-bottom: 7px;
        border-bottom: 1px dotted;
    }

   

    .item-summary-block span:last-child {
        font-weight: 700;
    }

    .item-contact-block {
        margin-top: 10px;
    }

    .cart-summart-block-main {
        position: -webkit-sticky;
        position: sticky;
        top: 20px;
        height: fit-content;
    }

    .bill-detail h5,
    .ship-detail h5 {
        font-size: 18px;
    }

    .bill-detail {
        border-bottom: 1px dotted;
        padding-bottom: 10px;
        margin-bottom: 10px;
        margin-top: 20px;
    }


    /* Popover Container */
    .custom-popover-container {
        position: relative;
        display: inline-block;
    }

    .custom-popover-container button{
        background-color: white;
    }


    /* Popover Content */
    .custom-popover-content {
        visibility: hidden;
        width: 250px;
        max-width: 80vw;
        /* Adjusts to viewport width */
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 8px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        /* Position above the button */
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        transition: opacity 0.3s, transform 0.3s;
    }

    .custom-popover-content p {
        font-size: 14px;
        margin-bottom: 0px;
    }

    /* Arrow */
    .custom-popover-content::after {
        content: "";
        position: absolute;
        top: 100%;
        /* Bottom of the popover */
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    /* Show Popover on Hover */
    .custom-popover-container:hover .custom-popover-content {
        visibility: visible;
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }

    /* Responsive Adjustments */
    @media (max-width: 600px) {
        .custom-popover-content {
            bottom: auto;
            top: 125%;
            /* Position below the button on small screens */
            transform: translateX(-50%) translateY(0);
        }

        .custom-popover-content::after {
            top: -5px;
            bottom: 100%;
            border-color: transparent transparent #555 transparent;
            /* Arrow points up */
        }
    }
</style>

@php
$order = $body['orderDetail'];
@endphp

<div class="layout-sidenav-content">
    <div class="p-4 p-md-5">

        <div class="row">

            <div class="col-12 col-sm-7 col-md-8 col-lg-8 mb-3">
                <h5>PURCHASED ITEMS</h5>


                @foreach($order['order_detail'] as $orderDetail)
                @if($orderDetail['product_sku'] != null)
                <div class="cart-item shadow p-2 mb-3">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="item-image-block text-center">
                                <img src="{{url('public/assets/img/product/').'/'.$orderDetail['product_sku'].'/'.$orderDetail['product_sku'].'_'.config('constant.COLOR_CODE.'.$orderDetail['product_color']).'1.webp'}}" class="img-thumbnail">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                            <div class="item-title-block">
                                <div class="row pt-2 pb-2">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="item-title-info-block">
                                            <h5>{{$orderDetail['product_sku']}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="item-price-info-block">
                                            {{\General::currency_format($orderDetail['product_buy_price'])}}
                                        </div>
                                    </div>
                                </div>
                                <div class="item-attribute-block">
                                    <table class="table table-hover item-attr-table">
                                        <tr>
                                            <td width="30%">Quantity </td>
                                            <td>{{$orderDetail['quantity']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Metal</td>
                                            <td>{{$orderDetail['product_gold_quality']}}KT {{$orderDetail['product_color']}} gold, {{$orderDetail['product_gold_weight']}} gm</td>
                                        </tr>
                                        @if($orderDetail['product_diamond_price'] > 0)
                                        @php
                                        $diamondDetail = json_decode($orderDetail['product_info']['diamond'], true);
                                        $diamondDetail = $diamondDetail[0];
                                        @endphp
                                        <tr>
                                            <td width="30%">Diamond</td>
                                            <td>{{$diamondDetail['quantity']}} Diamond, {{$diamondDetail['carat']}} Carat, {{ config('constant.'.$orderDetail['product_diamond_quality']) }}</td>
                                        </tr>
                                        @endif
                                        @if($orderDetail['product_size'] != null)
                                        <tr>
                                            <td width="30%">Size</td>
                                            <td>{{ $orderDetail['product_size'] }}</td>
                                        </tr>
                                        @endif
                                        @if($orderDetail['solitaire_preset_qty'] > 0)
                                        <tr>
                                            <th>Solitaire Details
                                            <th>
                                        </tr>
                                        <tr>
                                            <td width="30%">Shape</td>
                                            <td>Round</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Carat</td>
                                            <td>{{$orderDetail['solitaire_preset_carat']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Quality</td>
                                            <td>{{ config('constant.'.$orderDetail['solitaire_preset_quality']) }}</td>
                                        </tr>
                                        @endif
                                        @if($orderDetail['product_stone_price'] > 0)
                                        @php
                                        $stoneDetail = json_decode($orderDetail['product_info']['stone'], true);
                                        $stoneDetail = $stoneDetail[0];
                                        @endphp
                                        <tr>
                                            <th>Stone Details</th>
                                        </tr>
                                        <tr>
                                            <td width="30%">Type</td>
                                            <td>{{$stoneDetail['type']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Shape</td>
                                            <td>{{$stoneDetail['shape']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Color</td>
                                            <td>{{$stoneDetail['color']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Carat</td>
                                            <td>{{$stoneDetail['carat']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Quantity</td>
                                            <td>{{ $stoneDetail['quantity'] }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                                <div class="item-button-block">
                                    <select class="form-select bg-transparent order_status" name="order_status" id="order_status" data-id="{{$orderDetail['id']}}">
                                        <option value="0" @if($orderDetail['dispatch_status']==null || $orderDetail['dispatch_status']==0) {{"selected"}} @endif>Order Received</option>
                                        <option value="1" @if($orderDetail['dispatch_status']==1) {{"selected"}} @endif">Getting It Ready</option>
                                        <option value="2" @if($orderDetail['dispatch_status']==2) {{"selected"}} @endif">Shipped</option>
                                        <option value="3" @if($orderDetail['dispatch_status']==3) {{"selected"}} @endif">Delivered</option>
                                        <option value="-1" @if($orderDetail['dispatch_status']==-1) {{"selected"}} @endif">Cancelled</option>
                                        <option value="4" @if($orderDetail['dispatch_status']==4) {{"selected"}} @endif">Initiate Return</option>
                                        <option value="5" @if($orderDetail['dispatch_status']==5) {{"selected"}} @endif">Returned</option>
                                    </select>

                                    {{-- <div class="custom-popover-container">
                                        <button type="button" class="btn popover-button">Price Breakup <i class="fa fa-info-circle" aria-hidden="true"></i></button>
                                        <div class="custom-popover-content">
                                            <p>Gold : {{\General::currency_format($orderDetail['product_gold_price'])}} </p>
                                            <p>GST : {{\General::currency_format($orderDetail['product_gst_amount'])}} </p>
                                            @if($orderDetail['product_making_charges'] > 0)
                                            <p>Making Charge : {{\General::currency_format($orderDetail['product_making_charges'])}} </p>
                                            @endif
                                            @if($orderDetail['product_diamond_price'] > 0)
                                            <p>Diamond : {{\General::currency_format($orderDetail['product_diamond_price'])}} </p>
                                            @endif
                                            @if($orderDetail['preset_solitaire_price'] > 0)
                                            <p>Solitaire : {{\General::currency_format($orderDetail['preset_solitaire_price'])}} </p>
                                            @endif
                                            @if($orderDetail['product_stone_price'] > 0)
                                            <p>Stone : {{\General::currency_format($orderDetail['product_stone_price'])}} </p>
                                            @endif
                                        </div>
                                    </div> --}}

                                    
                                    @if($orderDetail['dispatch_status'] == -1)
                                    <div class="custom-popover-container">
                                        <button type="button" class="btn popover-button">Cancel Reason <i class="fa-solid fa-question"></i></button>
                                        <div class="custom-popover-content">
                                            <p>{{$orderDetail['cancel_reason']}}</p>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @elseif($orderDetail['solitaire_cert_no'] != null)
                @php
                $solitaireDetail = json_decode($orderDetail['solitaire'],true);
                @endphp
                <div class="cart-item shadow p-2 mb-3">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="item-image-block text-center">
                                <img src="{{$solitaireDetail['ImageLink']}}" class="img-thumbnail">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                            <div class="item-title-block">
                                <div class="row pt-2 pb-2">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="item-title-info-block">
                                            <h5>{{$solitaireDetail['Weight']}} Carat {{$solitaireDetail['DisplayShape']}} Diamond </h5>
                                            <h6><b>Mount : </b> {{$orderDetail['mount_product']}}</h6>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="item-price-info-block">
                                            {{\General::currency_format($orderDetail['product_buy_price'])}}
                                        </div>
                                    </div>
                                </div>
                                <div class="item-attribute-block">
                                    <table class="table table-hover item-attr-table">
                                        <tr>
                                            <td width="30%">Vendor </td>
                                            <td>{{$solitaireDetail['apiName']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">RefNo </td>
                                            <td>{{$solitaireDetail['RefNo']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Certificate</td>
                                            <td>{{$solitaireDetail['Cert']}}</a></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Certificate No </td>
                                            <td><a href="{{$solitaireDetail['CertLink']}}" target="_blank" rel="noopener noreferrer">{{$solitaireDetail['CertNo']}}</a></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Shape </td>
                                            <td>{{$solitaireDetail['DisplayShape']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Carat</td>
                                            <td>{{$solitaireDetail['Weight']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Clarity</td>
                                            <td>{{$solitaireDetail['Clarity']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Color</td>
                                            <td>{{$solitaireDetail['Color']}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="item-button-block">
                                    <select class="form-select bg-transparent order_status" name="order_status" id="order_status" data-id="{{$orderDetail['id']}}">
                                        <option value="0" @if($orderDetail['dispatch_status']==null || $orderDetail['dispatch_status']==0) {{"selected"}} @endif>Order Received</option>
                                        <option value="1" @if($orderDetail['dispatch_status']==1) {{"selected"}} @endif">Getting It Ready</option>
                                        <option value="2" @if($orderDetail['dispatch_status']==2) {{"selected"}} @endif">Shipped</option>
                                        <option value="3" @if($orderDetail['dispatch_status']==3) {{"selected"}} @endif">Delivered</option>
                                        <option value="-1" @if($orderDetail['dispatch_status']==-1) {{"selected"}} @endif">Cancelled</option>
                                        <option value="4" @if($orderDetail['dispatch_status']==4) {{"selected"}} @endif">Initiate Return</option>
                                        <option value="5" @if($orderDetail['dispatch_status']==5) {{"selected"}} @endif">Returned</option>
                                    </select>

                                    @if($orderDetail['dispatch_status'] == -1)
                                    <div class="custom-popover-container">
                                        <button type="button" class="btn popover-button">Cancel Reason <i class="fa-solid fa-question"></i></button>
                                        <div class="custom-popover-content">
                                            <p>{{$orderDetail['cancel_reason']}}</p>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach

            </div>

            <div class="col-12 col-sm-5 col-md-4 col-lg-4 mb-3">
                <div class="cart-summart-block-main">
                    <h5>ORDER SUMMARY</h5>
                    <div class="item-order-summary shadow p-3">
                        <div class="item-summary-block">
                            <span>Order Id </span>
                            <span>#{{$order['order_id']}}</span>
                        </div>
                        <div class="item-summary-block">
                            <span>Order Date </span>
                            <span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($orderDetail['created_at']))->format('d M Y') }}</span>
                        </div>
                        <div class="item-summary-block">
                            <span>Expected Delivery Date </span>
                            <span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($order['expected_delivery_date']))->format('d M Y') }}</span>
                        </div>
                        <div class="item-summary-block">
                            <span>Total ({{count($order['order_detail'])}} Items)</span>
                            <span>{{\General::currency_format($order['item_total'])}}</span>
                        </div>
                        @if($order['discount_total'] > 0)
                        <div class="item-summary-block">
                            <span class="text-success">Discount :</span>
                            <span class="text-success">{{\General::currency_format($order['discount_total'])}}</span>
                        </div>
                        @endif
                        <div class="item-summary-block">
                            <span>Order Total:</span>
                            <span>{{\General::currency_format($order['order_total'])}}</span>
                        </div>

                        <div class="bill-detail">
                            <h5 class="fw-bold mb-3 text-capitalize">Billing details</h5>
                            <p class="fw-bold"><i class="fa fa-user" aria-hidden="true"></i> {{$order['billing_address']['first_name'].' '.$order['billing_address']['last_name']}}</p>
                            <p class="mb-1"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$order['billing_address']['address']}}, {{$order['billing_address']['landmark']}} <br> {{$order['billing_address']['city']}}, {{$order['billing_address']['state']}}, {{$order['billing_address']['country']}}, {{$order['billing_address']['pincode']}} </p>
                            <p class="mb-1"><i class="fa fa-phone" aria-hidden="true"></i> {{$order['billing_address']['mobile_no']}}</p>
                            <p><i class="fa fa-envelope" aria-hidden="true"></i> {{$order['billing_address']['email']}}</p>
                        </div>

                        <div class="ship-detail">
                            <h5 class="fw-bold mb-3 text-capitalize">Shipping details</h5>
                            <p class="fw-bold"><i class="fa fa-user" aria-hidden="true"></i> {{$order['shipping_address']['first_name'].' '.$order['shipping_address']['last_name']}}</p>
                            <p class="mb-1"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$order['shipping_address']['address']}}, {{$order['shipping_address']['landmark']}} <br> {{$order['shipping_address']['city']}}, {{$order['shipping_address']['state']}}, {{$order['shipping_address']['country']}}, {{$order['shipping_address']['pincode']}} </p>
                            <p class="mb-1"><i class="fa fa-phone" aria-hidden="true"></i> {{$order['shipping_address']['mobile_no']}}</p>
                            <p><i class="fa fa-envelope" aria-hidden="true"></i> {{$order['shipping_address']['email']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Track Order Modal -->
        <div class="modal fade" id="trackOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="trackOrderLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-light text-dark">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="trackOrderLabel">Add Tracking URL</h1>
                        <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="save-tracking-form" method="post" action="">
                            <input type="hidden" name="order_status" id="order_status_val">
                            <input type="hidden" name="update_id" id="update_id">
                            <div class="form-floating w-100 mb-3">
                                <input type="text" class="form-control bg-transparent" name="order_tracking_id" id="order_tracking_id" placeholder="Enter Tracking URL">
                                <label for="category_name">Enter Tracking ID</label>
                            </div>
                            <div class="form-floating w-100 mb-3">
                                <input type="text" class="form-control bg-transparent" name="order_tracking_url" id="order_tracking_url" placeholder="Enter Tracking URL">
                                <label for="category_name">Enter Tracking URL</label>
                            </div>
                            <div class="form-floating w-100 mb-3">
                                <input type="text" class="form-control bg-transparent" name="tracking_note" id="tracking_note" placeholder="Enter Tracking URL">
                                <label for="category_name">Tracking Note</label>
                            </div>
                            <button type="button" id="tracking-order-btn-admin" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3" onclick="ChangeStatus()">Add <span id="tracking-spinner" style="display:none"><i class="fas fa-spinner fa-spin"></i></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        @stop
        @section('footer')

        <script>
            var orderListUrl = `{{url('admin/order/list')}}`;
            function ChangeStatus() {
                $('#tracking-spinner').show();
                $("#tracking-order-btn-admin").prop("disabled", true);
                let order_status = $('#order_status_val').val();
                $.ajax({
                    url: `{{ url('admin/order-status/update') }}`,
                    method: 'POST',
                    data: {
                        order_status: $('#order_status_val').val(),
                        update_id: $('#update_id').val(),
                        order_tracking_id: $('#order_tracking_id').val(), 
                        order_tracking_url: $('#order_tracking_url').val(),
                        tracking_note: $('#tracking_note').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        Toast(res.msg, 3000, res.flag);
                        $('#tracking-spinner').hide();
                        $("#tracking-order-btn-admin").removeAttr("disabled");
                        $("#save-tracking-form")[0].reset();
                        $('#order_status').val(order_status);
                        $("#trackOrder").modal("hide");
                        filterData(orderListUrl, "order-table");
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            $(document).ready(function() {
                $('.order_status').change(function() {
                    var $this = $(this);
                    var oldOrderStatus = $this.data('oldValue') || $this.val(); // Store the old value

                    $(this).data('oldValue', oldOrderStatus); // Save the current value as old value for future reference
                    $(this).next().show();
                    $(this).attr('disabled', 'disabled');
                    var order_status = $(this).val();

                    if (order_status == 2) {
                        $('#order_status_val').val(order_status);
                        $('#update_id').val($this.attr('data-id'));
                        $('#trackOrder').modal('show');
                        $(this).next().hide();
                        $(this).prop("disabled", false);

                        // Revert to old value when the modal is shown without proceeding
                        $('#trackOrder').on('hidden.bs.modal', function() {
                            $this.val(oldOrderStatus).prop("disabled", false);
                        });

                        return false;
                    } else {
                        $.ajax({
                            url: `{{ url('admin/order-status/update') }}`,
                            method: 'POST',
                            data: {
                                order_status: order_status,
                                update_id: $this.attr('data-id'),
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(res) {
                                $($this).removeAttr('disabled');
                                Toast(res.msg, 3000, res.flag);
                                filterData(orderListUrl, "order-table");
                                $this.next().hide();
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                $($this).removeAttr('disabled');
                                console.error(xhr.responseText);
                                // Revert to old value if AJAX fails
                                $this.val(oldOrderStatus).prop("disabled", false);
                                $this.next().hide();
                            }
                        });
                    }
                });

            });
        </script>
        @stop