<?php

return [

    'PLATFORM_NAME'                     => "Diamond Sutra",
    'ADMIN_PREFIX'                      => 'admin',

    'SYSTEM_EMAIL'                      => 'jewellery@no-reply.com',
    'SYSTEM_EMAIL_NAME'                 => 'Jewellery Shop',
    'SUPPORT_EMAIL'                     => env('SUPPORT_EMAIL', "info@jewellery.com"),

    'AUTH_TOKEN_STATUS'                 => 0,
    'WEB_DEVICE'                        => 0,
    'ANDROID_APP_DEVICE'                => 1,
    'IPHONE_APP_DEVICE'                 => 2,


    'BANNER_IMAGE_PATH'                 => 'assets/img/banner/',

    'TESTIMONIAL_IMAGE_PATH'            => 'assets/img/testimonial/',

    'PRODUCT_REVIEW_LINK'               => 'assets/img/reviews/',

    '1_XAU_TO_GOLD'                     => '31.1034768',

    'COLOR_CODE' => [
        'white'  => 'W',
        'rose'   => 'R',
        'yellow' => 'Y'
    ],
    'COLOR' => [
        'W' => 'white',
        'R' => 'rose',
        'Y' => 'yellow'
    ],
    'ORDER_STATUS' => [
        '-1' => 'Cancelled',
        '0' => 'Order Placed',
        '1' => 'Getting It Ready',
        '2' => 'Shipped',
        '3' => 'Delivered',
        '4' => 'Cancelled',
        '5' => 'Initiated Return',
        '6' => 'Returned'
    ],
    'ORDER_TYPE' => [
        'product' => 0,
        'preset' => 1,
        'solitaire' => 2,
        'loose_solitaire' => 3
    ],
    'PAYMENT_STATUS' => [
        '0' => 'Pending',
        '1' => 'Success',
        '2' => 'Failed'
    ],
    'OTP_TYPE' => [
        'LOGIN'          => 0,
        'SIGNUP'         => 1,
        'CONFIRM_ORDER'  => 2
    ],
    'IJ_SI' => 'IJ SI',
    'GH_SI' => 'GH SI',
    'GH_VS' => 'GH VS',
    'EF_VVS' => 'EF VVS',

    'DEFAULT_DIAMOND_QUALITY' => 'IJ_SI',
    'DEFAULT_GOLD_QUALITY' => 14,
    'DEFAULT_CURRENCY' => 'INR',
    'CURRENCY_SYMBOL' => '₹',

    'RING_SIZE_LIST' => array('8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27'),
    'BRACELATE_SIZE_LIST' => array('6','6.5','7','7.5','8'),
    'BANGLE_SIZE_LIST' => array('2','4','6','8','10','12','14','16'),
    'CHAIN_SIZE_LIST' => array('14','16','18','20'),
    'DEFAULT_RING_SIZE' => 12,
    'DEFAULT_BRACELATE_SIZE' => 7,
    'DEFAULT_BANGLE_SIZE' => '4',
    'DEFAULT_CHAIN_SIZE' => 16,
    'RING_INCREASE_PER_SIZE' => 0.10,
    'RING_DECREASE_PER_SIZE' => 0.10,
    'BRACELATE_INCREASE_PER_SIZE' => 13,
    'BRACELATE_DECREASE_PER_SIZE' => 13,
    'BANGLE_INCREASE_PER_SIZE' => 6,
    'BANGLE_DECREASE_PER_SIZE' => 4,
    'CHAIN_INCREASE_PER_SIZE' => 0,
    'CHAIN_DECREASE_PER_SIZE' => 0,
    'USER_PROFILE_PATH'        => public_path('assets/img/user_profile'),
    'USER_PROFILE_LINK'        => 'public/assets/img/user_profile',
    'USER_DUMMY_PROFILE_LINK'  => 'public/assets/img/avatar.png',
    'DISCOUNT' => [
        'PERCENTAGE' => 1,
        'FLAT' => 0,
    ],
    'DISCOUNT' => [
        'PERCENTAGE' => 1,
        'FLAT' => 0,
    ],
    'COUPON_TYPE' => [
        'TOTAL' => 0,
        'DIAMOND' => 1,
        'MAKING' => 2
    ],
    'PRODUCT_TYPE' => [
        'loose_solitaire' => 0,
        'SIGNUP'         => 1,
        'CONFIRM_ORDER'  => 2
    ],

    'DEFAULT_SOLITAIRE_PATH' => 'public/assets/img/solitaire/',

    'DIAMOND_COLOR' => [
        'IJ_SI' => 'IJ',
        'GH_SI' => 'GH',
        'GH_VS' => 'GH',
        'EF_VVS' => 'EF'
    ],
    'DIAMOND_PURITY' => [
        'IJ_SI' => 'SI',
        'GH_SI' => 'SI',
        'GH_VS' => 'VS',
        'EF_VVS' => 'VVS'
    ],

    'SCHEDULAR_NOTIFY_EMAIL' => 'bbtshivam@gmail.com'



];
