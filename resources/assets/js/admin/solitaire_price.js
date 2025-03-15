$(document).ready(function () {
    filterData(solitaireListUrl, "solitaire-price-table");
});

function edit(id, price, heading) {
    $("#update_id").val(id);
    $('#editSolitairePriceModalLabel').html('Update Price : ' + heading);
    $("#update_solitaire_price").val(price);
    $("#editSolitairePriceModal").modal("show");
}

$(document).on("click", "#update_solitaire_price_btn", function () {
    $("#update_solitaire_price_btn").prop("disabled", true);
    $("#update_solitaire_price_form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $("#update_solitaire_price_form")[0].reset();
                $("#editSolitairePriceModal").modal("hide");
                filterData(solitaireListUrl, "solitaire-price-table");
            }
            $("#update_solitaire_price_btn").prop("disabled", false);
        })
        .submit();
});
