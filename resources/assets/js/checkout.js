var format = new Intl.NumberFormat('hi-IN', {
    style: 'currency',
    currency: 'INR',
    minimumFractionDigits: 0,
});

$(document).on("click", "#same-as-billing-check", function () {
    if (!$("#same-as-billing-check").is(":checked")) {
        $("#shipping-address-btn").removeClass("collapsed");
        $("#shipping-address-btn").attr("area-expended", true);
        $("#collapseOne").addClass("show");
    } else {
        $("#shipping-address-btn").addClass("collapsed");
        $("#shipping-address-btn").attr("area-expended", false);
        $("#collapseOne").removeClass("show");
    }
});

$("#make-checkout").on("click", () => {
    $("#make-checkout").prop("disabled", true);
    $("#checkout-form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag === 1) {
                $("#checkout-form")[0].reset();
                setTimeout(function () {
                    window.location.href = $('#base_url').val() + "/order-detail/" + res.data.order_id
                }, 1000);
            }
            $("#make-checkout").prop("disabled", false);
        })
        .submit();
});

$("#applu-coupon-btn").on("click", () => {
    $("#applu-coupon-btn").prop("disabled", true);

    let url = $('#base_url').val() + '/coupon/apply'
    postAjax(url, { coupon: $('#coupanfield').val() }, function (res) {
        console.log(res);
        Toast(res.msg, 3000, res.flag);
        $("#applu-coupon-btn").prop("disabled", false);
        $('#coupanfield').val('')
        let couponDiv = `<tr>
                            <th class="p-2"><strong> Coupon Discount </strong></th>
                            <td class="p-2 text-end"><b>${format.format(res.data.discount)}/-</b></td>
                        </tr>`

        $('.selected_coupon_amount').text('₹' + res.data.discount + '/-');
        $('/selected_coupon_code').text(res.data.coupon_code);
        $('#shippind-detail-div').after(couponDiv);
        let final_amount = $('#cart-total').data('amount');
        console.warn('fiinal : ', final_amount);
        final_amount = parseInt(final_amount) - parseInt(res.data.discount);
        window.location.reload();
    });
});
