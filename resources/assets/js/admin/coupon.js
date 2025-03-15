$(document).ready(function () {
    filterData(couponListUrl, "coupon-table");
});

$(document).on("click", "#add_coupon_modal", function () {
    $("#addCouponModal").modal("show");
});
$(document).on("click", "#add_coupon_btn", function () {
    $("#add_coupon_btn").prop("disabled", true);
    $("#add_coupon_form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $("#add_coupon_form")[0].reset();
                $("#addCouponModal").modal("hide");
                filterData(couponListUrl, "coupon-table");
            }
            $("#add_coupon_btn").prop("disabled", false);
        })
        .submit();
});


function edit(id, name,discount_type,amount,expiry_date, status) {
    $("#update_id").val(id);
    $("#update_coupon_name").val(name);
    $("#update_coupon_discount").val(amount);
    $("#update_discount_type").val(discount_type);
    $("#update_coupon_expiry_date").val(expiry_date);
    $("#update_coupon_status").prop("checked", false);
    if (status) $("#update_coupon_status").prop("checked", true);
    $("#editCouponModal").modal("show");
}

$(document).on("click", "#update_coupon_btn", function () {
    $("#update_coupon_btn").prop("disabled", true);
    $("#update_coupon_form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $("#update_coupon_form")[0].reset();
                $("#editCouponModal").modal("hide");
                filterData(couponListUrl, "coupon-table");
            }
            $("#update_coupon_btn").prop("disabled", false);
        })
        .submit();
});

function Delete(id) {
    $("#delete_id").val(id);
    $("#deleteCouponModal").modal("show");
}

$(document).on("click", "#delete_coupon_btn", function () {
    $("#delete_coupon_btn").prop("disabled", true);
    $("#delete_coupon_form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $("#delete_coupon_form")[0].reset();
                $("#deleteCouponModal").modal("hide");
                filterData(couponListUrl, "coupon-table");
            }
            $("#delete_coupon_btn").prop("disabled", false);
        })
        .submit();
});
