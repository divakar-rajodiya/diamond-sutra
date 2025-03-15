<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diamond Sutra Order Shipped</title>
</head>

<body>
    @php
    $makingTotal = 0;
    $price_without_gst = 0;
    $gst = 0;
    @endphp

    <body link="#00a5b5" vlink="#00a5b5" alink="#00a5b5">

        <table class=" main contenttable" style="font-family: Arial, sans-serif;font-weight: normal;border-collapse: collapse;border: 0;margin-left: auto;margin-right: auto;padding: 0;color: #000;background-color: white;font-size: 16px;line-height: 26px;width: 600px;">
            <tr>
                <td class="border" style="margin: 0;padding: 0; background: #fff; box-shadow: 1px 6px 9px 0px #ccc;">
                    <table style="border-spacing: 0;">
                        <tr>
                            <td colspan="4" valign="top" class="image-section" style="background-color: #000; text-align: center; padding: 10px 0;">
                                <a href="{{ asset('/') }}" target="_blank">
                                    <img src="{{ asset('public/assets/img/white-diamon-sutra-logo.png')}}" alt="Diamond Sutra" width="186" height="39">
                                </a>
                                <p style="font-size: 12px; color: #fff; font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;">Certified natural diamond jewellery, fully customisable, made to order.</p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="side title" style="padding: 0;">
                                <table style="text-align: center; padding: 0 15px;">
                                    <tr>
                                        <td style="color: #000;font-size: 28px;line-height: 32px;font-weight: bold; padding: 20px 0;">
                                            Exciting news! Your order {{$orderDetail['order_id']}} has been shipped.
                                        </td>
                                    </tr>
                                  
                                    <tr>
                                        <td style="text-align: left; border-collapse: collapse;border: 0;margin: 0;padding: 0;padding-top:5px;-webkit-text-size-adjust: none;color: #000;font-size: 16px;line-height: 24px;font-weight: normal;">
                                            <table style="width: 100%;border-spacing: 0;">
                                                <tr>
                                                    <td style="text-align: center;" colspan="4">
                                                        <img width="100%" src="{{ asset('public/assets/img/arrow-timeline-3.png')}}" alt="Diamond Sutra promises">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="top" style="width: 25%; text-align: center; padding: 0;margin: 0; font-size: 12px; padding: 10px 0 0;">
                                                        <span style=" font-weight: 600;">Order received </span>
                                                        <p style="margin: 0;font-size: 12px; line-height: 12px;">
                                                            {{explode('T',$orderDetail['created_at'])[0]}}
                                                        </p>
                                                    </td>
                                                    <td valign="top" style="width: 25%; text-align: center; padding: 0;margin: 0; font-size: 12px; font-weight: 600; padding: 10px 0 0;"> Getting it ready</td>
                                                    <td valign="top" style="width: 25%; text-align: center; padding: 0;margin: 0; font-size: 12px; font-weight: 600; padding: 10px 0 0;"> Shipped
                                                    </td>
                                                    <td valign="top" style="width: 25%; text-align: center; padding: 0;margin: 0; font-size: 12px; padding: 10px 0 0;">
                                                        <span style="font-weight: 600;">Expected Delivery</span>
                                                        <p style="margin: 0;font-size: 12px; line-height: 12px;">{{ date('d-M-Y', strtotime($orderDetail['expected_delivery_date'])); }}</p>
                                                    </td>
                                                </tr>
                                                <tr style="text-align: center;">
                                                    <td style="text-align: center; padding: 40px 0;" colspan="4">
                                                        <a href="{{ url('/user/order-detail').'/'.$orderDetail['order_id'] }}" style="text-decoration: none; font-size: 16px;color: #fff; padding: 12px 20px; border-radius: 30px; background-color: #000;">View your order</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: #000;font-size: 16px;line-height: 22px;font-weight: normal;">
                                            <p style="padding:6px 10px;margin: 0 0 20px;">Delivery times are estimated. If you
                                                are experiencing difficulty with this order please contact us at <a href="tel:+91 9799975281" style="font-weight: 600; color: #000; text-decoration: none;">+91
                                                    9799975281</a> See more info.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 28px;font-weight: bold;color: #000; padding: 0 0 10px;text-transform: capitalize;">order details</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px;font-weight: normal;color: #000; padding: 0 0 20px;">Order Id : <span>#{{ $orderDetail['order_id'] }}</span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ccc; padding: 10px;">
                                <table style="width: 100%; vertical-align: top;">
                                    @foreach($orderDetail['order_detail'] as $item)
                                    @php
                                    $makingTotal += $item['product_making_charges'];
                                    $gst += $item['product_gst_amount'];
                                    $price_without_gst += ($item['product_buy_price'] - $item['product_gst_amount'] - $item['product_making_charges']);
                                    @endphp
                                    @if($item['product_sku'] != null)
                                    <tr>
                                        <td style="border: 1px solid #ccc; padding: 10px;">
                                            <table style="width: 100%; vertical-align: top;">
                                                <tr>
                                                    <td style="width: 20%;">
                                                        <img src="{{url('public/assets/img/product/').'/'.$item['product_sku'].'/'.$item['product_sku'].'_'.config('constant.COLOR_CODE.'.$item['product_color']).'1.webp'}}" style="height: 100px;width: 100%;object-fit: cover;" alt="">
                                                    </td>
                                                    <td style="padding: 0 10px;">
                                                        <p style="font-size: 18px; line-height: 22px;color: #000; margin: 0 0 5px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 350px;"> {{$item['product_info']['name']}} </p>
                                                        <p style="font-size: 16px; line-height: 18px;color: #000; margin: 0 0 4px;">Quantity : {{$item['quantity']}}</p>
                                                        <p style="font-size: 16px; line-height: 18px;color: #000; margin: 0 0 4px;">Metal : {{$item['product_gold_quality']}}KT {{$item['product_color']}} Gold, {{$item['product_gold_weight']}} gm</p>
                                                        @if($item['product_diamond_price'] > 0)
                                                        @php
                                                        $diamond = json_decode($item['product_info']['diamond'], true);
                                                        $diamond = $diamond[0];
                                                        @endphp
                                                        <p style="font-size: 16px; line-height: 18px;color: #000; margin: 0 0 4px;">Diamond : {{$diamond['quantity']}} {{$diamond['shape']}} Diamond, {{$diamond['carat']}} Carat, {{$item['product_diamond_quality']}}</p>
                                                        @endif
                                                        @if($item['product_stone_price'] > 0)
                                                        @php
                                                        $stone = json_decode($item['product_info']['stone'], true);
                                                        $stone = $stone[0];
                                                        @endphp
                                                        <p style="font-size: 16px; line-height: 18px;color: #000; margin: 0 0 4px;">Stone : {{$stone['quantity']}} {{$stone['shape']}} {{$stone['type']}}, {{$stone['carat']}} Carat</p>
                                                        @endif
                                                        @if($item['preset_solitaire_price'] > 0)
                                                        <p style="font-size: 16px; line-height: 18px;color: #000; margin: 0 0 4px;">Solitaire : {{$item['solitaire_preset_qty']}} Solitaire, {{$item['solitaire_preset_carat']}} carat, {{$item['solitaire_preset_quality']}}</p>
                                                        @endif
                                                        <p style="font-size: 16px; line-height: 18px;color: #000; margin: 0 0 4px;">Price : {{\General::currency_format($item['product_buy_price'] - $item['product_gst_amount'])}}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    @elseif($item['solitaire_cert_no'] != null)
                                    @php
                                    $solitaireDetail = json_decode($item['solitaire'],true);
                                    @endphp
                                    <tr>
                                        <td style="border: 1px solid #ccc; padding: 10px;">
                                            <table style="width: 100%; vertical-align: top;">
                                                <tr>
                                                    <td style="width: 20%;">
                                                        <img src="{{$solitaireDetail['ImageLink']}}" style="height: 100px;width: 100%;object-fit: cover;" alt="">
                                                    </td>
                                                    <td style="padding: 0 10px;">
                                                        <p style="font-size: 18px; line-height: 22px;color: #000; margin: 0 0 5px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 350px;">{{$solitaireDetail['Weight']}} Carat {{$solitaireDetail['DisplayShape']}} Diamond </p>
                                                        <p style="font-size: 16px; line-height: 18px;color: #000; margin: 0 0 4px;">Quantity : 1</p>
                                                        <p style="font-size: 16px; line-height: 18px;color: #000; margin: 0 0 4px;">Shape : {{$solitaireDetail['DisplayShape']}}</p>
                                                        <p style="font-size: 16px; line-height: 18px;color: #000; margin: 0 0 4px;">Carat : {{$solitaireDetail['Weight']}}</p>
                                                        <p style="font-size: 16px; line-height: 18px;color: #000; margin: 0 0 4px;">Clarity : {{$solitaireDetail['Clarity']}}</p>
                                                        <p style="font-size: 16px; line-height: 18px;color: #000; margin: 0 0 4px;">Color : {{$solitaireDetail['Color']}}</p>
                                                        <p style="font-size: 16px; line-height: 18px;color: #000; margin: 0 0 4px;">Price : {{\General::currency_format($item['product_buy_price'] - $item['product_gst_amount'])}}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="padding: 10px 10px 10px 0px; width: 48%; vertical-align: top;">
                                            <p style="font-size: 18px; font-weight: bold;color: #000;  margin: 0 0 5px;">Shipping Address</p>
                                            <p style="font-size: 18px; font-weight: bold;color: #000;  margin: 0 0 5px;">{{$orderDetail['shipping_address']['first_name']}} {{$orderDetail['shipping_address']['last_name']}}</p>
                                            <p style="margin: 0;">{{$orderDetail['shipping_address']['address']}}, {{$orderDetail['shipping_address']['landmark']}} <br> {{$orderDetail['shipping_address']['city']}}, {{$orderDetail['shipping_address']['state']}}, {{$orderDetail['shipping_address']['pincode']}}
                                            </p>
                                        </td>
                                        <td style="padding: 10px 0px 10px 0px; width: 52%; vertical-align: top;">
                                            <table style="width: 100%;">

                                                <tr style="font-size:15px;">
                                                    <td>Price</td>
                                                    <td style="font-weight: bold;text-align:right;">{{\General::currency_format($price_without_gst + $makingTotal)}}</td>
                                                </tr>
                                               
                                                <tr style="font-size:15px;">
                                                    <td>GST</td>
                                                    <td style="font-weight: bold;text-align:right;">{{\General::currency_format($gst)}}</td>
                                                </tr>

                                                <tr style="font-size:15px;">
                                                    <td style="border-top: 1px solid #ccc; padding: 10px 0;">Total</td>
                                                    <td style="border-top: 1px solid #ccc; padding: 10px 0;font-weight: bold;text-align:right;">{{\General::currency_format($price_without_gst + $gst + $makingTotal)}}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                <img src="{{ asset('public/assets/img/diamond-sutra-promises.png')}}" alt="Diamond Sutra promises">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; background: #ccc; padding: 10px 0;">© {{ date('Y'); }} Diamond Sutra. All Rights Reserved </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</body>

</html>