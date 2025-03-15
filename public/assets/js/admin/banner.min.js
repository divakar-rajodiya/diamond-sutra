$(document).ready(function () {
    filterData(bannerListUrl, "banner-table");
});

$(document).on("click", "#add_banner_modal", function () {
    $("#addBannerModal").modal("show");
});
$(document).on("click", "#add_banner_btn", function () {
    $("#add_banner_btn").prop("disabled", true);
    $("#add_banner_form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $("#add_banner_form")[0].reset();
                $("#addBannerModal").modal("hide");
                filterData(bannerListUrl, "banner-table");
            }
            $("#add_banner_btn").prop("disabled", false);
        })
        .submit();
});


function edit(id, image, sort_order,link) {
    $("#update_id").val(id);
    $("#update_banner_link").val(link);
    $("#update_sort_order").val(sort_order);
    $("#editBannerModal").modal("show");
}

$(document).on("click", "#update_banner_btn", function () {
    $("#update_banner_btn").prop("disabled", true);
    $("#update_banner_form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $("#update_banner_form")[0].reset();
                $("#editBannerModal").modal("hide");
                filterData(bannerListUrl, "banner-table");
            }
            $("#update_banner_btn").prop("disabled", false);
        })
        .submit();
});

function Delete(id) {
    $("#delete_id").val(id);
    $("#deleteBannerModal").modal("show");
}

$(document).on("click", "#delete_banner_btn", function () {
    $("#delete_banner_btn").prop("disabled", true);
    $("#delete_banner_form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $("#delete_banner_form")[0].reset();
                $("#deleteBannerModal").modal("hide");
                filterData(bannerListUrl, "banner-table");
            }
            $("#delete_banner_btn").prop("disabled", false);
        })
        .submit();
});
