<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diamond Sutra Order Cancelled</title>
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
                                <p style="font-size: 12px; color: #fff; font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;">Certified natural diamond jewellery, fully customisable, made to order.</p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="side title" style="padding: 0;">
                                <table style="text-align: center; padding: 0 15px;">
                                    <tr>
                                        <td style="color: #000;font-size: 28px;line-height: 32px;font-weight: bold; padding: 20px 0;">
                                            We regret that you have canceled the order <a href="{{ url('/order-detail').'/'.$orderDetail['order_id'] }}" target="_blank">{{ $orderDetail['order_id'] }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: #000;font-size: 14px;line-height: 32px; padding: 0px;">
                                            Cancel Reason : {{ $orderDetail['cancel_reason'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; border-collapse: collapse;border: 0;margin: 0;padding: 0;padding-top:5px;-webkit-text-size-adjust: none;color: #000;font-size: 16px;line-height: 24px;font-weight: normal;">
                                            <table style="width: 100%;border-spacing: 0;">
                
                                                <tr style="text-align: center;">
                                                    <td style="text-align: center; padding: 40px 0;" colspan="4">
                                                        <a href="{{ url('/order-detail').'/'.$orderDetail['order_id'] }}" style="text-decoration: none; font-size: 16px;color: #fff; padding: 12px 20px; border-radius: 30px; background-color: #000;">View your order</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td style="padding-bottom:10px;">
                                        Our team will get in touch with you regarding the refund and it should be processed within 7-8 working days to your account.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:10px;">
                                        If there's anything specific that led to this cancellation, or if there's anything we can do to improve your experience with us in the future, please do not hesitate to share your feedback. 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:10px;">
                                        Thank you for considering Diamond Sutra, and we sincerely hope to have the opportunity to serve you better in the future.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 28px;font-weight: bold;color: #000; padding: 0 0 10px;text-transform: capitalize;">Order details</td>
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
                                                {{ $orderDetail['product_info']['name'] }}
                                            </p>
                                            <p style="font-size: 18px; line-height: 22px;color: #000; margin: 0 0 5px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 350px; text-decoration: underline;">
                                                {{ $orderDetail['product_sku'] }}
                                            </p>
                                            <p style="font-size: 16px; line-height: 18px;color: #000; margin: 0 0 4px;">
                                                Color : {{$orderDetail['product_color']}}</p>
                                        </td>
                                        @if($orderDetail['is_chain'] == 1)
                                            @php  $chainDetail = json_decode($orderDetail['chain'],true); 
                                                    $chainPrice = $chainDetail['selected_buy_price']; @endphp
                                            <td style="font-size: 20px;font-weight: bold;color: #000;">{{\General::currency_format($orderDetail['product_final_amount']- $orderDetail['product_gst_amount'] - $chainPrice)}}</td>
                                        @elseif(isset($orderDetail['solitaire']))
                                            @php
                                            $solitaire = json_decode($orderDetail['solitaire'],true);
                                            if($orderDetail['product_info']['category_id'] == 1 || $orderDetail['product_info']['category_id'] == 4){
                                                $solitairePrice = $solitaire['Price'];
                                            } else {
                                                $solitairePrice = $solitaire['total_price'];
                                            }
                                            @endphp
                                            <td style="font-size: 20px;font-weight: bold;color: #000;">{{\General::currency_format($orderDetail['product_final_amount']- $orderDetail['product_gst_amount'] - $solitairePrice)}}</td>
                                        @else
                                            <td style="font-size: 20px;font-weight: bold;color: #000;">{{\General::currency_format($orderDetail['product_final_amount']- $orderDetail['product_gst_amount'])}}</td>
                                        @endif
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
                                                            <td style="font-weight: bold; text-align: right;">{{$chainDetail['product_sku']}} ({{$chainDetail['name']}})</td>
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
                                <td colspan="2">
                                <p style="font-size: 18px; font-weight: bold;color: #000;margin: 15px 0px 0px 0px;">Solitaires Details</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table border="1" style="width: 100%; border-collapse: collapse; border-color: #e5e5e5;">
                                        <tbody>
                                            <tr>
                                                <th style="text-align: center;padding: 3px;font-size:14px;">Image</th>
                                                <th style="text-align: center;padding: 3px;font-size:14px;">Carat</th>
                                                <th style="text-align: center;padding: 3px;font-size:14px;">Color</th>
                                                <th style="text-align: center;padding: 3px;font-size:14px;">Clarity</th>
                                                <th style="text-align: center;padding: 3px;font-size:14px;">Cut</th>
                                                <th style="text-align: center;padding: 3px;font-size:14px;">Price</th>
                                                <th style="text-align: center;padding: 3px;font-size:14px;">Cert. No.</th>
                                                <th style="text-align: center;padding: 3px;font-size:14px;">Cert.</th>
                                                
                                            </tr>
                                            
                                                @if($solitaire1)
                                                <tr>
                                                    <td style="text-align: center;padding: 3px;font-size:14px;">
                                                        <img src="{{$solitaire1['ImageLink']}}" style="height: 60px;width: 60px;object-fit: cover;" alt="">
                                                    </td>
                                                    <td style="text-align: center;padding: 3px;font-size:14px;">{{$solitaire1['Weight']}}</td>
                                            
                                                    <td style="text-align: center;padding: 3px;font-size:14px;">{{$solitaire1['Color']}}</td>
                                                
                                                    <td style="text-align: center;padding: 3px;font-size:14px;">{{$solitaire1['Clarity']}}</td>
                                                
                                                    <td style="text-align: center;padding: 3px;font-size:14px;">{{$solitaire1['DisplayCut']}}</td>
                                                
                                                    <td style="text-align: center;padding: 3px;font-size:14px;">{{\General::currency_format($solitaire1['Price'])}}</td>

                                                    <td style="text-align: center;padding: 3px;font-size:14px;">{{$solitaire1['CertNo']}}</td>

                                                    <td style="text-align: center;padding: 3px;font-size:14px;">{{$solitaire1['Cert']}}</td>
                                                </tr>
                                                @endif
                                                @if($solitaire2)
                                                <tr>
                                                    <td style="text-align: center;padding: 3px;font-size:14px;"><img src="{{$solitaire2['ImageLink']}}" style="height: 60px;width: 60px;object-fit: cover;" alt=""></td>
                                                    <td style="text-align: center;padding: 3px;font-size:14px;">{{$solitaire2['Weight']}}</td>
                                            
                                                    <td style="text-align: center;padding: 3px;font-size:14px;">{{$solitaire2['Color']}}</td>
                                                
                                                    <td style="text-align: center;padding: 3px;font-size:14px;">{{$solitaire2['Clarity']}}</td>
                                                
                                                    <td style="text-align: center;padding: 3px;font-size:14px;">{{$solitaire2['DisplayCut']}}</td>
                                                
                                                    <td style="text-align: center;padding: 3px;font-size:14px;">{{\General::currency_format($solitaire2['Price'])}}</td>

                                                    <td style="text-align: center;padding: 3px;font-size:14px;">{{$solitaire2['CertNo']}}</td>

                                                    <td style="text-align: center;padding: 3px;font-size:14px;">{{$solitaire1['Cert']}}</td>
                                                </tr>
                                                @endif
                                        </tbody>            
                                    </table>
                                </td>
                            </tr>
                        @endif

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
                                               
                                               @if($orderDetail['order_type'] == 'preset')
                                               <tr style="font-size:15px;">
                                                   <td>Solitaire Price</td>
                                                   <td style="font-weight: bold;text-align:right;">{{\General::currency_format($orderDetail['product_solitaire_price'])}}</td>
                                               </tr>
                                               @endif
                                               
                                               @if(isset($orderDetail['solitaire']))
                                               @php
                                               $solitaire = json_decode($orderDetail['solitaire'],true);
                                               @endphp
                                               @if($orderDetail['product_info']['category_id'] == 1 || $orderDetail['product_info']['category_id'] == 4)
                                               <tr style="font-size:15px;">
                                                   <td>Solitaire Price</td>
                                                   <td style="font-weight: bold;text-align:right;">{{\General::currency_format($solitaire['Price'])}}</td>
                                               </tr>
                                               @else
                                               <tr style="font-size:15px;">
                                                   <td>Solitaire Price</td>
                                                   <td style="font-weight: bold;text-align:right;">{{\General::currency_format($solitaire['total_price'])}}</td>
                                               </tr>
                                               @endif
                                               @endif


                                               @if(isset($orderDetail['product_diamond_price']) && $orderDetail['product_diamond_price'] > 0)
                                               <tr style="font-size:15px;">
                                                   <td>Diamond Price</td>
                                                   <td style="font-weight: bold;text-align:right;">{{\General::currency_format($orderDetail['product_diamond_price'])}}</td>
                                               </tr>
                                               @endif
                                               <tr style="font-size:15px;">
                                                   <td>Gold Price</td>
                                                   <td style="font-weight: bold;text-align:right;">{{\General::currency_format($orderDetail['product_gold_price'])}}</td>
                                               </tr>
                                               @if($orderDetail['is_chain'] == 1)
                                                    @php  $chainDetail = json_decode($orderDetail['chain'],true); 
                                                          $chainPrice = $chainDetail['selected_buy_price']; @endphp
                                                <tr>
                                                    <td>Chain Price</td>
                                                    <td style="font-weight: bold;text-align:right;">{{\General::currency_format($chainPrice)}}</td>
                                                </tr>
                                                @endif
                                               <tr style="font-size:15px;">
                                                   <td>Making Charges</td>
                                                   <td style="font-weight: bold;text-align:right;">{{\General::currency_format($orderDetail['product_making_charges'])}}</td>
                                               </tr>
                                               
                                               @if($orderDetail['coupon_code'] != null)
                                                <tr style="font-size:15px;">
                                                    <td>Coupon ({{$orderDetail['coupon_code']}})</td>
                                                    <td style="text-align: right;"><strong>- <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{\General::currency_format_pdf($orderDetail['discount_amount'])}}</strong></td>
                                                </tr>
                                                @endif
                                               <tr style="font-size:15px;">
                                                   <td>GST</td>
                                                   <td style="font-weight: bold;text-align:right;">{{\General::currency_format($orderDetail['product_gst_amount'])}}</td>
                                               </tr>
                                               
                                               <tr style="font-size:15px;">
                                                   <td style="border-top: 1px solid #ccc; padding: 10px 0;">Total</td>
                                                   <td style="border-top: 1px solid #ccc; padding: 10px 0;font-weight: bold;text-align:right;">{{\General::currency_format($orderDetail['product_final_amount'])}}</td>
                                               </tr>
                                           </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #000;font-size: 16px;line-height: 22px;font-weight: normal;">
                                <p style="padding:6px 10px;margin: 0 0 20px;">If you are experiencing difficulty with this order please contact us at <a href="tel:+91 9799975281" style="font-weight: 600; color: #000; text-decoration: none;">+91 9799975281</a> See more info.</p>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="text-align: left;padding-bottom:10px;">
                            Regards,<br>
                            Diamond Sutra<br>
                            9799975281, Mon-Fri, 9am-9pm<br>
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