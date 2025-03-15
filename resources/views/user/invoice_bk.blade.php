<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiamondSutra Order</title>
</head>

<body>

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
                                <p style="font-size: 12px; color: #fff; font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;">Certified natural diamond jewellery, fully customisable, made to order at a much lower price.</p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="side title" style="padding: 0;">
                                <table style="text-align: center; padding: 0 15px;">
                                    <tr>
                                        <td style="color: #000;font-size: 28px;line-height: 32px;font-weight: bold; padding: 20px 0;">
                                            Woohoo! Your order is confirmed.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: #000;font-size: 18px;line-height: 18px;font-weight: 500;padding:0;margin: 0;">
                                            Diamond Sutra will start working on this right away.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: #000;font-size: 18px;line-height: 18px;font-weight: 500; padding: 0 0 30px;">
                                            We will keep you posted on the progress of your item
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
                                        <td style="font-size: 16px;font-weight: normal;color: #000; padding: 0 0 20px;">Order Id : <span>{{ $orderDetail['order_id'] }}</span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ccc; padding: 10px;">
                                <table style="width: 100%; vertical-align: top;">
                                    <tr>
                                        <td style="width: 20%;">
                                            <img src="{{url('public/assets/img/product/').'/'.$orderDetail['product_sku'].'/'.$orderDetail['product_sku'].'_'.config('constant.COLOR_CODE.'.$orderDetail['product_color']).'1.jpg'}}" style="height: 100px;width: 100%;object-fit: cover;" alt="">
                                        </td>
                                        <td style="padding: 0 10px;">
                                            <p style="font-size: 18px; line-height: 22px;color: #000; margin: 0 0 5px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 350px; text-decoration: underline;">
                                                {{ $orderDetail['product_sku'] }}
                                            </p>
                                            <p style="font-size: 16px; line-height: 18px;color: #000; margin: 0 0 4px;">
                                                Transaction ID : 1234567890</p>
                                            <p style="font-size: 16px; line-height: 18px;color: #000; margin: 0 0 4px;">
                                                Color : {{$orderDetail['product_color']}}</p>
                                        </td>
                                        <td style="font-size: 20px;font-weight: bold;color: #000;">{{\General::currency_format($orderDetail['product_final_amount'])}}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        @if($orderDetail['is_chain'] == 1)
                            @php $chainDetail = json_decode($orderDetail['chain'],true); @endphp
                            <tr>
                                <td style="padding: 10px;background-color: #e5e5e5;" colspan="2">
                                <p style="font-size: 18px; font-weight: bold;color: #000;margin: 0;">
                                        Chain</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="order-id">
                                    <table style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 10px;background-color: #e5e5e5;">
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td>Image</td>
                                                            <td style="text-align:right"><img src="{{url('public/assets/img/product/').'/'.$chainDetail['product_sku'].'/'.$chainDetail['product_sku'].'_'.config('constant.COLOR_CODE.'.$chainDetail['selected_color']).'1.jpg'}}" style="height: 60px;width: 60px;object-fit: cover;" class="img-fluid" alt=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Product</td>
                                                            <td style="font-weight: bold; text-align: right;">{{$chainDetail['product_sku']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Color</td>
                                                            <td style="font-weight: bold; text-align: right;">{{$chainDetail['selected_color']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Price</td>
                                                            <td style="font-weight: bold; text-align: right;">{{\General::currency_format($chainDetail['selected_buy_price'])}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Quantity</td>
                                                            <td style="font-weight: bold; text-align: right;">1</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    #{{$orderDetail['order_id']}}
                                </td>
                                <!-- <td class="product-thumbnail" style="width: 20%;" >
                                    <img src="{{url('public/assets/img/product/').'/'.$chainDetail['product_sku'].'/'.$chainDetail['product_sku'].'_'.config('constant.COLOR_CODE.'.$chainDetail['selected_color']).'1.jpg'}}" class="img-fluid" alt="">
                                </td>
                                <td class="product-name">{{$chainDetail['product_sku']}}</td>
                                <td class="product-color">{{$chainDetail['selected_color']}}</td>
                                <td class="product-price">{{\General::currency_format($chainDetail['selected_buy_price'])}}</td>
                                <td class="product-qut">1</td> -->
                            </tr>
                        @endif

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
                            <tr>
                                <td style="padding: 10px;background-color: #e5e5e5;" colspan="2">
                                <p style="font-size: 18px; font-weight: bold;color: #000;margin: 0;">
                                        Solitaires</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                @if($solitaire1)
                                                <td style="padding: 10px;background-color: #e5e5e5;">
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td>Image</td>
                                                            <td style="text-align:right"><img src="{{$solitaire1['ImageLink']}}" style="height: 60px;width: 60px;object-fit: cover;" alt=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cert No</td>
                                                            <td style="font-weight: bold; text-align: right;">#{{$solitaire1['CertNo']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Carat</td>
                                                            <td style="font-weight: bold; text-align: right;">{{$solitaire1['Weight']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Color</td>
                                                            <td style="font-weight: bold; text-align: right;">{{$solitaire1['Color']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Clearty</td>
                                                            <td style="font-weight: bold; text-align: right;">{{$solitaire1['Clarity']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cut</td>
                                                            <td style="font-weight: bold; text-align: right;">{{$solitaire1['DisplayCut']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Price</td>
                                                            <td style="font-weight: bold; text-align: right;">{{\General::currency_format($solitaire1['Price'])}}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                @endif
                                                @if($solitaire2)
                                                <td style="padding: 10px;background-color: #e5e5e5;">
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td>Image</td>
                                                            <td style="text-align:right"><img src="{{$solitaire2['ImageLink']}}" style="height: 60px;width: 60px;object-fit: cover;" alt=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cert No</td>
                                                            <td style="font-weight: bold; text-align: right;">#{{$solitaire2['CertNo']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Carat</td>
                                                            <td style="font-weight: bold; text-align: right;">{{$solitaire2['Weight']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Color</td>
                                                            <td style="font-weight: bold; text-align: right;">{{$solitaire2['Color']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Clarity</td>
                                                            <td style="font-weight: bold; text-align: right;">{{$solitaire2['Clarity']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cut</td>
                                                            <td style="font-weight: bold; text-align: right;">{{$solitaire2['DisplayCut']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Price</td>
                                                            <td style="font-weight: bold; text-align: right;">{{\General::currency_format($solitaire2['Price'])}}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endif

                        <tr>
                            <td>
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="padding: 10px; width: 50%; vertical-align: top;">
                                            <p style="font-size: 18px; font-weight: bold;color: #000;  margin: 0 0 5px;">Shipping Address</p>
                                            <p style="font-size: 18px; font-weight: bold;color: #000;  margin: 0 0 5px;">{{$orderDetail['shipping_address']['first_name']}} {{$orderDetail['shipping_address']['last_name']}}</p>
                                            <p style="margin: 0;">{{$orderDetail['shipping_address']['address']}}, {{$orderDetail['shipping_address']['landmark']}} <br> {{$orderDetail['shipping_address']['city']}}, {{$orderDetail['shipping_address']['state']}}, {{$orderDetail['shipping_address']['pincode']}}
                                            </p>
                                        </td>
                                        <td style="padding: 10px; width: 50%; vertical-align: top;">
                                            <table style="width: 100%;">
                                                <!-- <tr>
                                                    <td>
                                                        <p
                                                            style="font-size: 18px; font-weight: bold;color: #000;  margin: 0 0 5px;">
                                                            Paid with <span
                                                                style="font-size: 16px; font-weight: normal;">Credit
                                                                card</span></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>subtotal</td>
                                                    <td style="font-weight: bold;">$16.00</td>
                                                </tr>
                                                <tr>
                                                    <td>sales tax</td>
                                                    <td>$16.00</td>
                                                </tr>
                                                <tr>
                                                    <td>shipping</td>
                                                    <td>$16.00</td>
                                                </tr> -->
                                                @if(isset($orderDetail['product_diamond_price']) && $orderDetail['product_diamond_price'] > 0)
                                                <tr>
                                                    <td>Diamond Price</td>
                                                    <td style="font-weight: bold;">{{\General::currency_format($orderDetail['product_diamond_price'])}}</td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <td>Gold Price</td>
                                                    <td>{{\General::currency_format($orderDetail['product_gold_price'])}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Making Charges</td>
                                                    <td>{{\General::currency_format($orderDetail['product_making_charges'])}}</td>
                                                </tr>
                                                <tr>
                                                    <td>GST</td>
                                                    <td>{{\General::currency_format($orderDetail['product_gst_amount'])}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #ccc; padding: 10px 0;">Total</td>
                                                    <td style="border-top: 1px solid #ccc; padding: 10px 0;">{{\General::currency_format($orderDetail['product_final_amount'])}}</td>
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
