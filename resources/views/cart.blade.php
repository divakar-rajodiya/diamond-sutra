@extends('layouts.site')

@section('header')

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
        justify-content: center;
        margin-top: 5px;
        margin-bottom: 5px;
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
        top: 120px;
        height: fit-content;
    }

    /* Price Breakup start */
    .popover-content {
        display: none;
        position: absolute;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 90%;
        z-index: 1000;
        transform: translateY(10px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    
    .popover-content p{
        font-size:14px;
        font-weight: 500;
    }

    .popover-content p span{
        display:inline-block;
        min-width:110px;
        font-weight:400;
    }

    .popover-content.show {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .popover-content::before {
        content: '';
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
        border-width: 0 10px 10px 10px;
        border-style: solid;
        border-color: transparent transparent #fff transparent;
        z-index: -1;
    }

    .popover-content::after {
        content: '';
        position: absolute;
        top: -11px;
        left: 50%;
        transform: translateX(-50%);
        border-width: 0 11px 11px 11px;
        border-style: solid;
        border-color: transparent transparent #ccc transparent;
        z-index: -2;
    }

    /* Price Breakup end */
</style>
@stop

@section('content')

<main>
    <div class="page-title mb-3">
        <div class="page-breadcrumb">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">My Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- <div class="cart-main"></div> -->
    <div class="container">
        <div class="row mt-5">

            <div class="col-12 col-sm-6 col-md-8 col-lg-8 mb-3" id="cart-table">
                <h5>CART ITEMS</h5>
                <div class="cart-item shadow p-2 mb-3">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="item-image-block text-center">
                                <img src="https://dev.diamondsutra.in/public/assets/img/product/DSRI237/DSRI237_W1.webp" class="img-thumbnail">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                            <div class="item-title-block">
                                <div class="row pt-2 pb-2">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="item-title-info-block">
                                            <h5>Soliter 1</h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="item-price-info-block">
                                            Rs. 12000
                                        </div>
                                    </div>
                                </div>
                                <div class="item-attribute-block">
                                    <table class="table table-hover item-attr-table">
                                        <tr>
                                            <td>Quantity </td>
                                            <td>
                                                <select class="qty">
                                                    <option value="1" selected="">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Metal</td>
                                            <td>18K Rose Gold, 3.06 gm</td>
                                        </tr>
                                        <tr>
                                            <td>Stone</td>
                                            <td>97 Diamond, 0.3260 Carat, SI IJ</td>
                                        </tr>
                                        <tr>
                                            <td>Clarity</td>
                                            <td>SI2</td>
                                        </tr>
                                        <tr>
                                            <td>Color</td>
                                            <td>J</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="item-button-block">
                                    <button type="button" class="btn remove-item-btn"> <i class="fa-solid fa-xmark"></i> Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cart-item shadow p-2 mb-3">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="item-image-block text-center">
                                <img src="https://dev.diamondsutra.in/public/assets/img/product/DSRI237/DSRI237_W1.webp.v1.webp" class="img-thumbnail">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                            <div class="item-title-block">
                                <div class="row pt-2 pb-2">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="item-title-info-block">
                                            <h5>Title t itlelem d sdfjsdf sdj</h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="item-price-info-block">
                                            Rs. 12000
                                        </div>
                                    </div>
                                </div>
                                <div class="item-attribute-block">
                                    <table class="table table-hover item-attr-table">
                                        <tr>
                                            <td>Quantity </td>
                                            <td>
                                                <select class="qty">
                                                    <option value="1" selected="">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Metal</td>
                                            <td>18K Rose Gold, 3.06 gm</td>
                                        </tr>
                                        <tr>
                                            <td>Stone</td>
                                            <td>97 Diamond, 0.3260 Carat, SI IJ</td>
                                        </tr>
                                        <tr>
                                            <td>Clarity</td>
                                            <td>SI2</td>
                                        </tr>
                                        <tr>
                                            <td>Color</td>
                                            <td>J</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="item-button-block">
                                    <button type="button" class="btn remove-item-btn"><i class="fa-solid fa-xmark"></i> Remove</button>
                                    <button type="button" class="btn browse-chain-btn">Brows Chains</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-sm-5 col-md-4 col-lg-4 mb-3">
                <div class="cart-summart-block-main">
                    <h5>CART SUMMARY</h5>
                    <div class="item-order-summary shadow p-3">
                        <div class="item-summary-block">
                            <span id="sm_total_items">Total (4 Items)</span>
                            <span id="sm_cart_total"></span>
                        </div>
                        <div class="item-summary-block">
                            <span>Discount (<i id="coupon_note" class="text-success"></i>)</span>
                            <span id="sm_coupon_discount">Rs. 1,000</span>
                        </div>
                        <div class="item-summary-block">
                            <span>Total Payable</span>
                            <span id="sm_cart_payable">Rs. 1,00,000</span>
                        </div>
                        <div class="coupan-main-block mt-4">
                            <h6>I have a Coupon code / gift card</h6>
                            <div id="coupon-section">
                                <form id="apply-coupon" class="d-flex align-items-center gap-2 border fs-12" onsubmit="return: false;">
                                    <input type="text" class="form-control bg-transparent border-0 shadow-none" id="coupon_code" placeholder="Enter Code" value="" required="">
                                    <button type="button" id="apply_coupon_btn" class="btn bg-black rounded-0 text-white">Apply
                                        <span id="apply_coupon_btn_spinner" class="d-none" style="margin-right: 4px"><i class="fa fa-spinner fa-spin"></i></span></button>
                                </form>
                            </div>
                            <div id="applied_coupon_section" class="d-none">
                                <form id="applied-coupon" class="d-flex align-items-center gap-2 border fs-12" onsubmit="return: false;">
                                    <input type="text" class="form-control bg-transparent border-0 shadow-none" id="applied_coupon_code" readonly>
                                    <button type="button" id="remove_coupon_btn" class="btn bg-black rounded-0 text-white">Remove</button>
                                </form>
                            </div>
                            </form>

                        </div>
                        <button type="button" id="place-order-btn" class="btn primary-btn w-100 mt-3 mb-2 mb-sm-3">Place Order</button>
                        <div class="item-contact-block">
                            <p>Any Questions?</p>
                            <p>Please call us at <b><a href="tel:+919799975281">+91 9799975281</a></b> or Chat with us <a href="https://api.whatsapp.com/send?phone=919799975281&amp;text=Hi! Need information on the product | https://diamondsutra.in" class="fs-4 text-success p-1"><i class="fa-brands fa-whatsapp"></i></a></p>
                                
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@stop

@section('footer')
<script>
    var format = new Intl.NumberFormat('hi-IN', {
        style: 'currency',
        currency: 'INR',
        minimumFractionDigits: 0,
    });

    $(document).ready(function() {
        refreshCartData();
        displayCart();

        // Call the function on page load
        updateCouponUI();


        $(document).on('click', ".minus", function() {
            var $input = $(this).parent().find("input");
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $(document).on('click', ".plus", function() {
            var $input = $(this).parent().find("input");
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });

        $(document).on('click', '.popover-button', function(event) {
            event.stopPropagation(); // Prevent the event from bubbling up
            var popover = $(this).next('.popover-content');
            var rect = this.getBoundingClientRect();
            var top = rect.bottom + window.scrollY;
            var left = rect.left + (rect.width / 2) - (popover.outerWidth() / 2) + window.scrollX;

            popover.css({
                top: top + 'px',
                left: Math.max(10, Math.min(left, $(window).width() - popover.outerWidth() - 10)) + 'px'
            }).toggleClass('show').not(':visible').siblings('.popover-content').removeClass('show');
        });

        $(document).click(function(event) {
            if (!$(event.target).closest('.popover-button, .popover-content').length) {
                $('.popover-content').removeClass('show');
            }
        });

        $(window).resize(function() {
            $('.popover-content').removeClass('show');
        });

        $(document).on('change', '.cart-product-qty', function() {
            let selectedQuantity = parseInt($(this).val());
            let productId = $(this).data('id');
            let cart = JSON.parse(localStorage.getItem('cart')) || {};

            // Update the cart in localStorage
            if (cart[productId]) {
                cart[productId].quantity = selectedQuantity;
                localStorage.setItem('cart', JSON.stringify(cart));
                // Recalculate the total and update the cart display
                displayCart();
                refreshCartData();
            }

        });


        $(document).on('click', '#place-order-btn', function() {

            let base_url = $('#base_url').val();
            let token = $('#token').val();
            let cart = JSON.parse(localStorage.getItem('cart')) || {};
            let appliedCoupon = JSON.parse(localStorage.getItem('appliedCoupon')) || null;

            var param = {
                _token: token,
                coupon_code: 'NA',
                cartData: cart
            };
            if (appliedCoupon) {
                if (appliedCoupon.code != undefined) {
                    param.coupon_code = appliedCoupon.code;
                }
            }

            $.ajax({
                type: 'POST',
                url: base_url + '/start-checkout',
                data: param,
                success: function(res) {
                    console.log(res);
                    if (res.flag === 1) {
                        window.location.href = base_url + '/checkout-method';
                    } else {
                        Toast(res.msg, 3000, res.flag);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });


    });

    function displayCart() {
        
        // Retrieve the cart summery data from localStorage
        let cartSummery = JSON.parse(localStorage.getItem('cartSummery')) || {};
        
        // Retrieve the cart data from localStorage
        let cartData = JSON.parse(localStorage.getItem('cart')) || {};
        
        // Convert cart object to an array of its values (so that we can sort)
        let cartArray = Object.values(cartData);
        
        // Sort the array based on the 'sort_index' key in ascending order
        cartArray.sort(function(a, b) {
            return a.sort_index - b.sort_index;
        });
        
        // Optional: Convert the sorted array back to an object (if needed)
        let cart = {};
        cartArray.forEach(item => {
            cart[item.cart_id] = item;
        });
        
        // let cart = JSON.parse(localStorage.getItem('cart')) || {};
        let $cartTable = $('#cart-table');
        $cartTable.empty();

        $.each(cart, function(id, details) {
            console.log(details);

            let newRow = '';

            if (details.RefNo != undefined) {
                let strikePriceHtml = '';
                if (details.coupon_discount > 0) {
                    let strikeAmount = parseInt(details.product_buy_price_with_gst) + parseInt(details.coupon_discount);
                    strikePriceHtml = ` <span><strike> ${format.format(strikeAmount) + '/-'}</span></strike> `;
                }
                newRow = ` <div class="cart-item shadow p-2 mb-3">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="item-image-block text-center">
                                <img src="${details.ImageLink || ''}" class="img-thumbnail" onerror="this.onerror=null; this.src='http://dev.diamondsutra.in/public/assets/img/solitaire/${details.DisplayShape}.jpg';">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                            <div class="item-title-block">
                                <div class="row pt-2 pb-2">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="item-title-info-block">
                                            <h5>${details.name}</h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="item-price-info-block">
                                            ${format.format(details.product_buy_price_with_gst) + '/-'}
                                        </div>
                                    </div>
                                </div>
                                <div class="item-attribute-block">
                                    <table class="table table-hover item-attr-table">
                                        
                                        <tr>
                                            <td width="30%">Shape</td>
                                            <td>${details.DisplayShape}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Carat</td>
                                            <td>${details.Weight}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Clarity</td>
                                            <td>${details.Clarity}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Color</td>
                                            <td>${details.Color}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="item-button-block">
                                    <button type="button" class="btn remove-item-btn" data-id="${id}"> <i class="fa-solid fa-xmark"></i> Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;


            } else if (details.sku != undefined) {
                // Similar code for products with SKU
                let priceBreakupContent = '';

                if (details.gold_price > 0) {
                    priceBreakupContent += `<p><span>Gold :</span> ${format.format(details.gold_price)}/- </p>`;
                }
                if (details.diamond_buy_price > 0) {
                    priceBreakupContent += `<p><span>Diamond :</span> ${format.format(details.diamond_buy_price)}/- </p>`;
                }
                if (details.preset_solitaire_price > 0) {
                    priceBreakupContent += `<p><span>Solitaire :</span> ${format.format(details.preset_solitaire_price)}/- </p>`;
                }
                if (details.stone_price > 0) {
                    priceBreakupContent += `<p><span>Stone :</span> ${format.format(details.stone_price)}/- </p>`;
                }
                priceBreakupContent += `<p><span>Making Charge :</span> ${format.format(details.product_making_charge)}/- </p>`;
                priceBreakupContent += `<p><span>GST :</span> ${format.format(details.product_gst)}/- </p>`;
                let strikePriceHtml = '';
                if (details.coupon_discount > 0) {
                    let strikeAmount = parseInt(details.product_buy_price_with_gst) + parseInt(details.coupon_discount);
                    strikePriceHtml = ` <span><strike> ${format.format(strikeAmount) + '/-'}</span></strike> `;
                }

                newRow = ` <div class="cart-item shadow p-2 mb-3">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="item-image-block text-center">
                                <img src="${details.chart.image_list[details.color] || ''}" class="img-thumbnail" onerror="this.onerror=null; this.src='http://dev.diamondsutra.in/public/assets/img/diamond.png';">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                            <div class="item-title-block">
                                <div class="row pt-2 pb-2">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="item-title-info-block">
                                            <h5>${details.name}</h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="item-price-info-block">
                                            ${format.format(details.product_buy_price_with_gst) + '/-'}
                                        </div>
                                    </div>
                                </div>
                                <div class="item-attribute-block">
                                    <table class="table table-hover item-attr-table">`;
                if(details.product_type == 'product'){
                    newRow +=  `<tr>
                                    <td width="30%">Quantity </td>
                                    <td>
                                        <select class="cart-product-qty" data-id="${details.cart_id}">
                                            <option value="1" ${details.quantity == 1 ? 'selected' : ''}>1</option>
                                            <option value="2" ${details.quantity == 2 ? 'selected' : ''}>2</option>
                                            <option value="3" ${details.quantity == 3 ? 'selected' : ''}>3</option>
                                            <option value="4" ${details.quantity == 4 ? 'selected' : ''}>4</option>
                                            <option value="5" ${details.quantity == 5 ? 'selected' : ''}>5</option>
                                        </select>
                                    </td>
                                </tr>`;
                }
                if (details.size != undefined) {
                    newRow += `<tr>
                              <td width="30%">Size</td>
                              <td>${details.size}</td>
                          </tr>`;
                }
                newRow += `<tr>
                              <td width="30%">Metal</td>
                              <td>${details.goldCarat}K ${details.color} gold, ${details.gold_weight} gm</td>
                          </tr>`;

                if (details.diamond_quantity > 0) {
                    newRow += `<tr>
                              <td width="30%">Diamond</td>
                              <td>${details.diamond_quantity} diamond, ${details.diamond_carat} carat, ${details.diamond.replace('_', ' ')}</td>
                          </tr>`;
                }
                if (details.solitaire != null) {
                    newRow += `<tr> <th>Solitaire Details<th> </tr>
                            <tr>
                              <td width="30%">Shape</td>
                              <td>Round</td>
                            </tr>
                            <tr>
                              <td width="30%">Carat</td>
                              <td>${details.solitaireCarat}</td>
                            </tr>
                            <tr>
                              <td width="30%">Quality</td>
                              <td>${details.solitaire.replace('_'," ")}</td>
                            </tr>`;
                }

                if (details.stone_price > 0) {
                    newRow += `<tr> <th>Stone Details<th> </tr>
                            <tr>
                                <td width="30%">Type</td>
                                <td>${details.stone_detail.type}</td>
                            </tr>
                            <tr> 
                                <td width="30%">Shape</td>
                                <td>${details.stone_detail.shape}</td>
                            </tr>
                            <tr>
                                <td width="30%">Color</td>
                                <td>${details.stone_detail.color}</td>
                            </tr>
                            <tr>
                                <td width="30%">Carat</td>
                                <td>${details.stone_detail.carat}</td>
                            </tr>
                            <tr>
                                <td width="30%">Quantity</td>
                                <td>${details.stone_detail.quantity}</td>
                            </tr>`;
                }


                let browseChainBtn = ``;
                if (details.with_chains === 'no') {
                    browseChainBtn = `<a href="${$('#base_url').val() +'/jewellery/Chains'}" class="btn browse-chain-btn" data-id="${id}"> Browse Chain</a> `;
                }
                
                // price breakup code
                // <button type="button" id="popoverButton${id}" class="btn popover-button">Price Breakup <i class="fa fa-info-circle" aria-hidden="true"></i></button>
                //                         <div id="popoverContent${id}" class="popover-content">
                //                             ${priceBreakupContent}
                //                         </div>
                newRow += `</table>
                                </div>
                                <div class="item-button-block">
                                        
                                        <button type="button" class="btn remove-item-btn" data-id="${id}"> <i class="fa-solid fa-xmark"></i> Remove</button>
                                        ${browseChainBtn}
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>`;

            }
            $cartTable.append(newRow);
        });
        $cartTable.append(`  <div class="diamondsutra-promises border bg-light py-3 px-4 fs-12">
                    <p class="mb-2 pb-2 d-block text-uppercase fw-bold border-bottom fs-12" style="letter-spacing: 2px;">Diamond Sutra Promises</p>
                    <div class="row">
                        <div class="col-lg-6 col-6 col-12">
                            <ul class="list-unstyled m-0">
                                <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-certificate me-2 text-center" style="width:16px"></i> 100% certified jewelry</li>
                                <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-hand-holding-dollar me-2 text-center" style="width:16px"></i> 15-day refund policy</li>
                                <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-repeat me-2 text-center" style="width:16px"></i> Lifetime Exchange &amp; Buyback</li>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-6 col-12">
                            <ul class="list-unstyled m-0">
                                <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-truck-fast me-2 text-center" style="width:16px"></i> Free Shipping and Insurance</li>
                                <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-money-bill-wave me-2 text-center" style="width:16px"></i> Transparent Pricing</li>
                                <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-compress me-2 text-center" style="width:16px"></i> Complementary Resizing</li>
                            </ul>
                        </div>
                    </div>
                </div> `);


        calculateTotal();
    }

    function calculateTotal() {
        let cart = JSON.parse(localStorage.getItem('cart')) || {};
        let appliedCoupon = JSON.parse(localStorage.getItem('appliedCoupon')) || null;
        let cartSummery = JSON.parse(localStorage.getItem('cartSummery')) || null;

        // let total = 0;
        // let discount = 0;
        // let gst = 0;
        // let itemCount = 0;
    
        // $.each(cart, function(id, details) {
        //     total += details.product_buy_price_with_gst;
        //     itemCount++;
        // });

        // Format the total
        // let formattedTotal = format.format(total) + '/-';

        // Display the total and item count
        // $('#sm_cart_total').text(formattedTotal);
        // $('#sm_total_items').text(`Total (${itemCount} Items)`);

        if(cartSummery){
            $('#sm_cart_total').text(format.format(cartSummery.itemTotal) + '/-');
            $('#sm_total_items').text(`Total (${cartSummery.itemCount} Items)`);
            $('#sm_cart_payable').text(format.format(cartSummery.orderTotal) + '/-');
            if(cartSummery.discountAmount > 0 && appliedCoupon){
                $('#sm_coupon_discount').text(format.format(cartSummery.discountAmount) + '/-');
                $('#coupon_note').text(appliedCoupon.coupon_note);
                $('#sm_coupon_discount').closest('.item-summary-block').show();
            } else {
                $('#sm_coupon_discount').closest('.item-summary-block').hide();
            }
        }

        // If a coupon is applied, calculate the total discount and payable amount
        // if (appliedCoupon) {
        //     $.each(cart, function(id, details) {
        //         discount += details.coupon_discount || 0;
        //     });

        //     // Format the discount
        //     let formattedDiscount = format.format(discount) + '/-';
        //     let totalPayable = total - discount;
        //     let formattedTotalPayable = format.format(totalPayable) + '/-';

        //     // Display the discount and total payable
        //     $('#sm_coupon_discount').text(formattedDiscount);
        //     $('#coupon_note').text(appliedCoupon.coupon_note);
        //     $('#sm_cart_payable').text(formattedTotalPayable);

        //     // Show the discount section
        //     $('#sm_coupon_discount').closest('.item-summary-block').show();
        // } else {
        //     // If no coupon is applied, hide the discount section and just display the total payable
        //     $('#sm_coupon_discount').closest('.item-summary-block').hide();
        //     $('#sm_cart_payable').text(formattedTotal);
        // }

        // Handle the coupon input visibility
        if (appliedCoupon) {
            $('#coupon_code').val(appliedCoupon.code).prop('readonly', true);
            $('#coupon-section').addClass('d-none');
            $('#applied_coupon_section').removeClass('d-none');
        } else {
            $('#coupon_code').val('').prop('readonly', false);
            $('#coupon-section').removeClass('d-none');
            $('#applied_coupon_section').addClass('d-none');
        }
    }


    $(document).on('click', '#apply_coupon_btn', function() {
        // $('#apply_coupon_btn_spinner').removeClass('d-none');
        $('#apply_coupon_btn').attr('disabled', true);
        $('#apply_coupon_btn').text('Please wait..');
        console.log('appluy coupon trioggerd');
        let base_url = $('#base_url').val();
        let token = $('#token').val();
        let couponCode = $('#coupon_code').val();
        let cart = JSON.parse(localStorage.getItem('cart')) || {};
        console.log('validate coupon code : ', couponCode);
        $('#validate_coupon').attr('disabled', true);
        $('#validate_coupon').text('Please wait..');
        $.ajax({
            type: 'POST',
            url: base_url + '/apply-coupon',
            data: {
                _token: token,
                coupon_code: couponCode,
                cartData: cart
            },
            success: function(res) {
                Toast(res.msg, 3000, res.flag);
                if (res.flag === 1) {
                    applyCoupon(res.data.couponData.couponCode, res.data.couponData.discountAmount, res.data.couponData.discountType, res.data.couponData.couponType,  res.data.couponData.min_amount, res.data.couponData.up_to_amount, res.data.couponData.coupon_note);

                    updateCartSummery(res.data.cartSummery);
                    updateCouponUI();
                    localStorage.setItem('cart', JSON.stringify(res.data.cartData));
                    displayCart();
                } else {
                    $('#is_valid_coupon').val(0);
                }
                // $('#apply_coupon_btn_spinner').addClass('d-none');
                $('#apply_coupon_btn').removeAttr('disabled');
                $('#apply_coupon_btn').text('Apply');
                // applyCouponToCart();
            },
            error: function(xhr, status, error) {
                console.error(error);
                Toast('Ooops! Something went wrong. Try again later.', 3000, 0);
            }
        });
    });

    $('#remove_coupon_btn').click(function() {
        // Remove the coupon from localStorage
        localStorage.removeItem('appliedCoupon');
        // Update UI
        updateCouponUI();

        $('#remove_coupon_btn').attr('disabled', true);
        $('#remove_coupon_btn').text('Please wait..');
        let base_url = $('#base_url').val();
        let token = $('#token').val();
        let cart = JSON.parse(localStorage.getItem('cart')) || {};
        $.ajax({
            type: 'POST',
            url: base_url + '/remove-coupon',
            data: {
                _token: token,
                cartData: cart
            },
            success: function(res) {
                console.log(res);
                if (res.flag === 1) {
                    localStorage.removeItem('appliedCoupon');
                    updateCouponUI();
                    updateCartSummery(res.data.cartSummery);
                    localStorage.setItem('cart', JSON.stringify(res.data.cartData));
                    displayCart();
                } else {
                    $('#is_valid_coupon').val(0);
                }
                $('#remove_coupon_btn').removeAttr('disabled');
                $('#remove_coupon_btn').text('Remove');
            },
            error: function(xhr, status, error) {
                console.error(error);
                Toast('Ooops! Something went wrong. Try again later.', 3000, 0);
            }
        });

    });


    function refreshCartData() {

        let base_url = $('#base_url').val();
        let token = $('#token').val();
        let cart = JSON.parse(localStorage.getItem('cart')) || {};
        let appliedCoupon = JSON.parse(localStorage.getItem('appliedCoupon')) || null;

        var param = {
            _token: token,
            coupon_code: 'NA',
            cartData: cart
        };
        if (appliedCoupon) {
            if (appliedCoupon.code != undefined) {
                param.coupon_code = appliedCoupon.code;
            }
        }

        $.ajax({
            type: 'POST',
            url: base_url + '/refresh-cart-data',
            data: param,
            success: function(res) {
                console.log(res);
                if (res.flag === 1) {
                    localStorage.setItem('cart', JSON.stringify(res.data.cartData));
                    updateCartSummery(res.data.cartSummery);
                    if(res.data.couponData == null){
                        localStorage.removeItem('appliedCoupon');
                        updateCouponUI();
                    }
                    displayCart();
                } else if (res.flag == 3) {
                    localStorage.removeItem('appliedCoupon');
                    updateCouponUI();
                    window.location.href = base_url;
                } else {
                    $('#is_valid_coupon').val(0);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        refreshCartLogo();
    }

    function updateCouponUI() {
        let appliedCoupon = JSON.parse(localStorage.getItem('appliedCoupon')) || null;

        if (appliedCoupon) {
            // Show the applied coupon code and remove button
            $('#coupon-section').addClass('d-none');
            $('#applied_coupon_section').removeClass('d-none');
            $('#applied_coupon_code').val(appliedCoupon.code);
        } else {
            // Show the coupon input and apply button
            $('#coupon-section').removeClass('d-none');
            $('#applied_coupon_section').addClass('d-none');
            $('#coupon_code').val('');
        }
    }

    function applyCoupon(couponCode, discountAmount, discountType, couponType, min_amount, up_to_amount, coupon_note) {
        let couponDetails = {
            code: couponCode,
            discountAmount: discountAmount,
            discountType: discountType, // 0: Flat, 1: Percentage
            couponType: couponType, // 0: Discount on Product, 1: Discount on Diamond, 2: Discount on Making
            min_amount: min_amount,
            up_to_amount: up_to_amount,
            coupon_note: coupon_note
        };

        localStorage.setItem('appliedCoupon', JSON.stringify(couponDetails));
    }

    function updateCartSummery(cartSummery){
        if(cartSummery != null){
            localStorage.setItem('cartSummery', JSON.stringify(cartSummery));
        }
    }


    $(document).on('click', '.remove-item-btn', function() {
        let cart_id = $(this).data('id');
        removeFromCart(cart_id);
    });

    async function checkCoupon(cart){
        console.warn('check coupon called', cart);
        let base_url = $('#base_url').val();
        let token = $('#token').val();
        let couponCode = $('#coupon_code').val();
        $.ajax({
            type: 'POST',
            url: base_url + '/check-coupon',
            data: {
                _token: token,
                coupon_code: couponCode,
                cartData: cart
            },
            success: function(res) {
                if (res.flag !== 1) {
                    $('#remove_coupon_btn').trigger('click');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                Toast('Ooops! Something went wrong. Try again later.', 3000, 0);
            }
        });
    }

    async function removeFromCart(id) {   
        let cart = JSON.parse(localStorage.getItem('cart')) || {};
        let bindedValue = cart[id].binded;
        console.log('binded value: ', bindedValue);

        if (cart[id].mount_id != undefined || cart[id].mount_id != null) {
            mount_id = cart[id].mount_id;
            if (cart[id].product_type == 'solitaire' || cart[id].product_type == 'solitaire_pair') {
                for (let key in cart) {
                    if (cart[key].mount_id == mount_id) {
                        delete cart[key];
                    }
                }
            } else if (cart[id].product_type == 'solitaire_setting') {
                console.warn(mount_id)
                console.log(cart[id])
                if (cart[mount_id] != undefined) {
                    if (cart[mount_id].product_type == 'solitaire') {
                        cart[mount_id].product_type = 'loose_solitaire';
                        cart[mount_id].mount_id = '';
                    } else if (cart[mount_id].product_type == 'solitaire_pair') {
                        cart[mount_id].product_type = 'loose_solitaire_pair';
                        cart[mount_id].mount_id = '';
                    }
                }
            }
            delete cart[id];
        }
        if (bindedValue > 0) {
            for (let key in cart) {
                if (cart[key].binded == bindedValue) {
                    delete cart[key];
                    console.log('deleted', cart[key]);
                    console.log('binded value: ', cart[key]);
                }
            }
        } else {
            delete cart[id];
        }

        let res = await checkCoupon(cart);

        localStorage.setItem('cart', JSON.stringify(cart));
        refreshCartData();
        displayCart();
    }
</script>
@stop