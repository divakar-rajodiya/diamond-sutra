<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice {
            padding: 0px;
            background-color: #ffffff;
            max-width: 800px;
            margin: 0 auto;
        }

        .invoice-logo {
            text-align: center;
        }

        .invoice-logo img {
            width: 40%;
        }

        .invoice h5 {
            text-align: center;
            margin-bottom: 20px;
            margin-top: 5px;
        }

        .invoice h4 {
            margin-bottom: 5px;
            margin-top: 15px;
        }

        .invoice p {
            margin: 5px 0px;
            font-size: 14px;
        }

        .invoice .details {
            margin-bottom: 10px;
        }

        .invoice .details h3 {
            margin-bottom: 10px;
            margin-top: 0px;
        }

        .invoice .details span {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .invoice .details .company-details {
            float: left;
            width: 50%;
        }

        .invoice .details .customer-details {
            float: right;
            width: 50%;
        }

        .invoice .details:after {
            content: "";
            display: table;
            clear: both;
        }

        .invoice .invoice-items {
            border-collapse: collapse;
            width: 100%;
        }

        .invoice .invoice-items th,
        .invoice .invoice-items td {
            border: 1px solid #ccc;
            padding: 5px;
            text-align: left;
            font-size: 14px;
        }

        .invoice .invoice-items th {
            background-color: #f2f2f2;
        }

        .soliter-detail:after {
            content: "";
            display: table;
            clear: both;
            /* margin-top:10px; */
        }

        .soliter-detail {
            margin-top: 10px;
        }

        .soliter-detail .full-soliter {
            width: 100%;
            margin-top: 10px;
        }

        .full-soliter tr td {
            width: 50%;
        }

        .invoice-footer h3 {
            text-align: center;
            margin-bottom: 5px;
        }

        .footer-info div {
            float: left;
            width: 33%;
            text-align: center;
        }
    </style>
</head>

<body>
    @php
        $diamondTotal = 0;
        $stoneTotal = 0;
        $solitaireTotal = 0;
        $goldTotal = 0;
        $makingTotal = 0;
    @endphp
    <div class="invoice">
        <div class="invoice-logo">
            <img src="https://diamondsutra.in/public/assets/img/vertical-black-logo.svg">
        </div>
        <h5>Tax Invoice/Bill of Supply/Cash Memo</h5>
        <div class="details">
            <div class="company-details">
                <h3>Company Details</h3>
                <span><strong>Company Name:</strong> DiamondSutra</span>
                <span><strong>Address:</strong> C-69, SHIKSHA VIHAR, SKIT ROAD,<br>JAGATPURA, Jaipur 302017</span>
                <span><strong>Email:</strong> info@diamondsutra.in</span>
                <span><strong>Phone:</strong> +91 9799975281</span>
                <span><strong>GST:</strong> 08ABFPJ0542C1Z8</span>
                <span><strong>PAN:</strong> ABFPJ0542C</span>
                <span><strong>HSN/SAC:</strong> 7113</span>
                
            </div>
            <div class="customer-details">
                <h3>Customer Details</h3>
                <span><strong>Customer Name:</strong> {{$orderDetail['billing_address']['first_name']}} {{$orderDetail['billing_address']['last_name']}}</span>
                <span><strong>Billing Address:</strong> {{$orderDetail['billing_address']['address']}}, {{$orderDetail['billing_address']['landmark']}} <br> {{$orderDetail['billing_address']['city']}}, {{$orderDetail['billing_address']['state']}}, {{$orderDetail['billing_address']['pincode']}}</span>
                <span><strong>Email:</strong> {{$orderDetail['billing_address']['email']}}</span>
                <span><strong>Phone:</strong> {{$orderDetail['billing_address']['mobile_no']}}</span>
                <p><strong>Order Number: {{ $orderDetail['order_id'] }} </strong></p>
                <p><strong>Order Date: </strong> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($orderDetail['created_at']))->format('d M Y') }} </p>
                <p><strong>Invoice Date: </strong> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($orderDetail['created_at']))->format('d M Y') }} </p>
            </div>
        </div>

        <h4>Order Items</h4>
        <table class="invoice-items">
            <thead>
                <tr>
                    <th>Item Details</th>
                    <th>Qty</th>
                    <th>Color</th>
                    <th>Purity</th>
                    <th>Gold Wt.</th>
                    <th>Ct Wt.</th>
                    <th>Gold Rate</th>
                    <th>Price</th>
                    <th>Making</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderDetail['order_detail'] as $item)
                @php
                    if($item['product_diamond_price'] > 0) $diamondTotal += $item['product_diamond_price'];
                    if($item['product_gold_price'] > 0) $goldTotal += $item['product_gold_price'];
                    if($item['product_making_charges'] > 0) $makingTotal += $item['product_making_charges'];
                    if($item['solitaire_price_inr'] > 0) $solitaireTotal += $item['solitaire_price_inr'];
                    if($item['product_stone_price'] > 0) $stoneTotal += $item['product_stone_price'];
                @endphp

                @if($item['product_sku'] != null)
                @php $diamondDetail = null; @endphp
                <tr>
                    <td>
                        <strong>{{$item['product_info']['name']}}</strong><br>

                        <strong>Gold:</strong> <span style="text-transform: capitalize;">{{$item['product_gold_quality']}}KT</span><br>

                        @if($item['product_size'] != '')
                        <strong>Size:</strong> {{$item['product_size']}} <br>
                        @endif
                        @if($item['product_diamond_quality'] != null)
                            @php
                                $diamondDetail = json_decode($item['product_info']['diamond'],true);
                                $diamondDetail = $diamondDetail[0];
                            @endphp
                            @if($diamondDetail['quantity'] > 0)
                            <strong>Diamond:</strong> <span style="text-transform: capitalize;">{{$diamondDetail['quantity']}} diamond</span>
                            @endif
                        @endif
                        @if($item['solitaire_preset_qty'] > 0)
                        <br><strong>Sol.:</strong>{{$item['solitaire_preset_qty']}} Diamond Round
                        @endif

                        @if($item['product_stone_price'] > 0)
                            <br><strong>Stone:</strong> <span style="text-transform: capitalize;">
                            @php
                            $stoneDetail = json_decode($item['product_info']['stone'], true);
                            $stoneDetail = $stoneDetail[0];
                            @endphp
                            {{ $stoneDetail['quantity'] }} {{$stoneDetail['shape']}} {{$stoneDetail['type']}}, {{$stoneDetail['color']}} color, {{$stoneDetail['carat']}} Ct. </span>
                        @endif
                    </td>
                    <td>{{$item['quantity']}}</td>
                    <td>
                        {{ucfirst($item['product_color'])}}
                        @if($item['product_diamond_quality'] != null)
                        <br>{{config('constant.DIAMOND_COLOR.'.$item['product_diamond_quality'])}}
                        @endif
                    </td>
                    <td>
                        @if($item['product_gold_quality'] != null)
                        {{$item['product_gold_quality']}}KT
                        @endif
                        @if($item['product_diamond_quality'] != null)
                        <br>{{config('constant.DIAMOND_PURITY.'.$item['product_diamond_quality'])}}
                        @endif
                    </td>
                    <td>{{$item['product_gold_weight']}}gm
                        @if($item['product_diamond_quality'] != null) <br>- @endif
                    </td>
                    <td>
                        -
                        @if($diamondDetail != null)
                        <br>{{$diamondDetail['carat']}}Ct
                        @endif
                    </td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;{{\General::currency_format_pdf($item['gold_rate'])}}</span></td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;{{\General::currency_format_pdf($item['product_buy_price'] - $item['product_gst_amount'] - $item['product_making_charges'])}}</span></td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;{{\General::currency_format_pdf($item['product_making_charges'])}}</span></td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;{{\General::currency_format_pdf($item['product_buy_price'] - $item['product_gst_amount'])}}</span></td>

                </tr>

                @else
                    @php
                    $solitaireDetail = json_decode($item['solitaire'],true);
                    @endphp

                <tr>
                    <td>
                        <strong>{{$solitaireDetail['Weight']}} Ct. {{$solitaireDetail['DisplayShape']}} Diamond (Sol.)</strong><br>
                        <strong>Clarity:</strong> <span style="text-transform: capitalize;">{{$solitaireDetail['Clarity']}}</span><br>
                        <strong>Color:</strong> <span style="text-transform: capitalize;">{{$solitaireDetail['Color']}}</span>
                    </td>
                    <td>1</td>
                    <td>{{$solitaireDetail['Color']}}</td>
                    <td>{{$solitaireDetail['Clarity']}}</td>
                    <td>-</td>
                    <td>{{$solitaireDetail['Weight']}}Ct</td>
                    <td>-</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;{{\General::currency_format_pdf($item['product_buy_price'] - $item['product_gst_amount'])}}</span></td>
                    <td>-</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;{{\General::currency_format_pdf($item['product_buy_price'] - $item['product_gst_amount'])}}</span></td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>

        <div class="soliter-detail">
            <div class="full-soliter">
                <table class="invoice-items">
                    <thead>
                        <tr>
                            <th colspan="2">Summary</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($diamondTotal > 0)
                        <tr>
                            <td>Diamond Price</td>
                            <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;{{\General::currency_format_pdf($diamondTotal)}}</span></strong></td>
                        </tr>
                        @endif
                        @if($stoneTotal > 0)
                        <tr>
                            <td>Stone Price</td>
                            <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;{{\General::currency_format_pdf($stoneTotal)}}</span></strong></td>
                        </tr>
                        @endif
                        @if($solitaireTotal > 0)
                        <tr>
                            <td>Solitaire Price</td>
                            <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;{{\General::currency_format_pdf($solitaireTotal)}}</span></strong></td>
                        </tr>
                        @endif
                        @if($goldTotal > 0)
                        <tr>
                            <td>Gold Price</td>
                            <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;{{\General::currency_format_pdf($goldTotal)}}</span></strong></td>
                        </tr>
                        @endif
                        @if($makingTotal > 0)
                        <tr>
                            <td>Making Charges</td>
                            <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;{{\General::currency_format_pdf($makingTotal)}}</span></strong></td>
                        </tr>
                        @endif
                         <tr>
                            <td>Item Total</td>
                            <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;{{\General::currency_format_pdf($orderDetail['item_total'] - $orderDetail['gst_total'])}}</span></strong></td>
                        </tr>
                        <tr>
                            <td>GST</td>
                            <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;{{\General::currency_format_pdf($orderDetail['gst_total'])}}</span></strong></td>
                        </tr>
                        @if($orderDetail['coupon_code'] != null)
                        <tr>
                            <td>Coupon Code ({{$orderDetail['coupon_code']}})</td>
                            <td style="text-align: right;"><strong>- <span style="font-family: DejaVu Sans; sans-serif;">&#8377; {{\General::currency_format_pdf($orderDetail['discount_total'])}}</span></strong></td>
                        </tr>
                        @endif
                        <tr>
                            <td>Total</td>
                            <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;{{\General::currency_format_pdf($orderDetail['order_total'])}}</span></strong></td>
                        </tr>
                    </tbody>
                </table>
                <p>*SUBJECT TO JAIPUR JURISDICTION This is a Computer-generated Invoice</p>
            </div>
        </div>

        <div class="invoice-footer">
            <h3>Thank You</h3>
            <div class="footer-info">
                <div>Phone:+91 9799975281</div>
                <div>Email: info@diamondsutra.in</div>
                <div>Website: https://diamondsutra.in</div>
            </div>
        </div>
    </div>
</body>

</html>