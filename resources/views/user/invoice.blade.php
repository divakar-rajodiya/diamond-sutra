

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
    text-align:center;
}
.invoice-logo img{
    width:40%;
}
.invoice h5 {
    text-align: center;
    margin-bottom: 20px;
    margin-top:5px;
}
.invoice h4 {
    margin-bottom:5px;
    margin-top:15px;
}
.invoice p {
    margin:5px 0px;
    font-size:14px;
}
.invoice .details {
    margin-bottom: 10px;
}
.invoice .details h3 {
    margin-bottom: 10px;
    margin-top:0px;
}
.invoice .details span {
    display: block;
    margin-bottom: 5px;
    font-size:14px;
}
.invoice .details .company-details{
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
.invoice .invoice-items th, .invoice .invoice-items td {
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
    margin-top:10px;
}
.soliter-detail .full-soliter{
    width:100%;
    margin-top:10px;
}
.full-soliter tr td{
    width:50%;
}
.invoice-footer h3{
    text-align:center;
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
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{ $orderDetail['product_sku'] }} ({{$orderDetail['product_info']['name']}})<br>
                    <strong>Color:</strong> <span style="text-transform: capitalize;">{{$orderDetail['product_color']}}</span><br>
                    @if($orderDetail['product_size'] != '')
                    <strong>Size:</strong> {{$orderDetail['product_size']}} K<br>
                    @endif
                    <strong>Gold:</strong> {{$orderDetail['product_gold_quality']}} K<br>
                    <strong>Gold Weight:</strong> {{$orderDetail['product_gold_weight']}} gm
                </td>
                <td>1</td>


                @if($orderDetail['is_chain'] == 1)
                    @php  $chainDetail = json_decode($orderDetail['chain'],true); 
                            $chainPrice = $chainDetail['selected_buy_price']; @endphp
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($orderDetail['product_final_amount'] - $chainPrice)}}</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($orderDetail['product_final_amount'] - $chainPrice)}}</td>
                @elseif(isset($orderDetail['solitaire']))
                    @php
                    $solitaire = json_decode($orderDetail['solitaire'],true);
                    if($orderDetail['product_info']['category_id'] == 1 || $orderDetail['product_info']['category_id'] == 4){
                        $solitairePrice = $solitaire['Price'];
                    } else {
                        $solitairePrice = $solitaire['total_price'];
                    }
                    @endphp
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($orderDetail['product_final_amount']- $solitairePrice)}}</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($orderDetail['product_final_amount']- $solitairePrice)}}</td>
                @else
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($orderDetail['product_final_amount'])}}</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($orderDetail['product_final_amount'])}}</td>
                @endif


                
            </tr>
            @if($orderDetail['is_chain'] == 1)
                @php  $chainDetail = json_decode($orderDetail['chain'],true);
                $SKU = $chainDetail['product_sku'];
                $COLOR = $chainDetail['selected_color'];
                @endphp
                <tr>
                    <th colspan="4"> Chain Details</th>
                </tr>
                <tr>
                    <td>
                        {{$chainDetail['product_sku']}} ({{$chainDetail['name']}}) <br>
                        <strong>Color:</strong> {{$chainDetail['selected_color']}}<br>
                        <strong>Gold:</strong> {{$chainDetail['selected_gold_carat']}} K<br>
                        <strong>Gold Weight:</strong> {{$chainDetail['selected_gold_weight']}} gm
                    </td>
                    <td>1</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($chainDetail['selected_buy_price'])}}</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($chainDetail['selected_buy_price'])}}</td>
                </tr>
            @endif
        </tbody>
    </table>
    @if($orderDetail['solitaire'] != '')
        @php
        $solitaire = json_decode($orderDetail['solitaire'],true);
        $solitaire1 = null;
        $solitaire2 = null;
        if(isset($solitaire['RefNo'])){
            $solitaire1 = $solitaire;
        } elseif(isset($solitaire[0]['RefNo'])){
            $solitaire1 = $solitaire[0];
            $solitaire2 = $solitaire[1];
        }
        @endphp
        <div class="soliter-detail">
            <h4>Solitaire Details</h4>
            <table class="invoice-items">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Carat</th>
                        <th>Color</th>
                        <th>Clarity</th>
                        <th>Cut</th>
                        <th>Price</th>
                        <th>Ceritificate</th>
                        <th>Cer. No.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{$solitaire1['Weight']}} Ct</td>
                        <td>{{$solitaire1['Color']}}</td>
                        <td>{{$solitaire1['Clarity']}}</td>
                        <td>{{$solitaire1['DisplayCut']}}</td>
                        <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($solitaire1['Price'])}}</td>
                        <td>{{$solitaire1['Cert']}}</td>
                        <td>{{$solitaire1['CertNo']}}</td>
                    </tr>
                    @if($solitaire2)
                    <tr>
                        <td>2</td>
                        <td>{{$solitaire2['Weight']}} Ct</td>
                        <td>{{$solitaire2['Color']}}</td>
                        <td>{{$solitaire2['Clarity']}}</td>
                        <td>{{$solitaire2['DisplayCut']}}</td>
                        <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($solitaire2['Price'])}}</td>
                        <td>{{$solitaire2['Cert']}}</td>
                        <td>{{$solitaire2['CertNo']}}</td>
                    </tr>
                    @endif
                </tbody>
            </table> 
        </div>
    @endif

    @if(isset($orderDetail['product_diamond_quality']) && $orderDetail['product_diamond_quality'] != null)
    <div class="soliter-detail">
        <div class="full-soliter">
            <table class="invoice-items">
                <thead>
                    <tr>
                        <th colspan="2">Diamond Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Quality</td>
                        <td>{{ config('constant.'.$orderDetail['product_diamond_quality']) }}</td>
                    </tr>
                    @php
                        $product = \App\Models\Admin\Product::where('product_sku',$orderDetail['product_sku'])->first();
                        $diamond = json_decode($product->diamond);
                    @endphp
                    <tr>
                        <td>Weight</td>
                        <td>{{ $diamond[0]->carat  }} Ct</td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td>{{ $diamond[0]->quantity  }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif


    <div class="soliter-detail">
        <div class="full-soliter">
            <table class="invoice-items">
                <thead>
                    <tr>
                        <th colspan="2">Summary</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($orderDetail['product_diamond_price']) && $orderDetail['product_diamond_price'] > 0)
                    <tr>
                        <td>Diamond Price</td>
                        <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($orderDetail['product_diamond_price'])}}</strong></td>
                    </tr>
                    @endif

                    @if($orderDetail['order_type'] == 'preset')
                    <tr>
                        <td>Solitaire Price</td>
                        <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($orderDetail['product_solitaire_price'])}}</strong></td>
                    </tr>
                    @endif

                    @if(isset($orderDetail['solitaire']))
                        @php
                        $solitaire = json_decode($orderDetail['solitaire'],true);
                        @endphp
                        @if($orderDetail['product_info']['category_id'] == 1 || $orderDetail['product_info']['category_id'] == 4)
                        <tr>
                            <td>Solitaire Price</td>
                            <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($solitaire['Price'])}}</strong></td>
                        </tr>
                        @else
                        <tr>
                            <td>Solitaire Price</td>
                            <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($solitaire['total_price'])}}</strong></td>
                        </tr>
                        @endif
                    @endif
                    <tr>
                        <td>Gold Price</td>
                        <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($orderDetail['product_gold_price'])}}</strong></td>
                    </tr>

                    @if($orderDetail['is_chain'] == 1)
                        @php  $chainDetail = json_decode($orderDetail['chain'],true); 
                                $chainPrice = $chainDetail['selected_buy_price']; @endphp
                        <tr>
                            <td>Chain Price</td>
                            <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($chainPrice)}}</strong></td>
                        </tr>
                    @endif

                    <tr>
                        <td>Making Charges</td>
                        <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($orderDetail['product_making_charges'])}}</strong></td>
                    </tr>
                    @if($orderDetail['coupon_code'] != null)
                    <tr>
                        <td>Coupon Code ({{$orderDetail['coupon_code']}})</td>
                        <td style="text-align: right;"><strong>- <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($orderDetail['discount_amount'])}}</strong></td>
                    </tr>
                    @endif
                    <tr>
                        <td>GST</td>
                        <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($orderDetail['product_gst_amount'])}}</strong></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td style="text-align: right;"><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($orderDetail['product_final_amount'])}}</strong></td>
                    </tr>
                </tbody>
            </table>
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
