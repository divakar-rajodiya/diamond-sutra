$(document).on("click", "#upload-csv-btn", function () {
    $("#upload-csv-btn").prop("disabled", true);
    $("#upload-csv-form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $("#upload-csv-form")[0].reset();
                filterData(productUrl, "product-table");
            }
            $("#upload-csv-btn").prop("disabled", false);
        })
        .submit();
});
var slim;
$(document).ready(function () {
    filterData(productUrl, "product-table");
    let val = $("#categorySelect").find(":selected").val();
    console.log(val);
    slim = new SlimSelect({
        select: "#multiple",
        settings: {
            hideSelected: true,
            closeOnSelect: false,
        },
    });
    
    postAjax(getSubCategory, { id: val }, function (res) {
        console.log(res);
        let tempArr = [];
        res.data.forEach((ele) => {
            tempArr.push({ value: ele.id, text: ele.name });
        });
        slim.setData(tempArr);
    });
});

$(document).on("change", "#categorySelect", function () {
    let val = $(this).val();
    console.log(val);
    postAjax(getSubCategory, { id: val }, function (res) {
        console.log(res);
        let tempArr = [];
        res.data.forEach((ele) => {
            tempArr.push({ value: ele.id, text: ele.name });
        });
        console.log(tempArr);
        slim.setData(tempArr);
    });
});

function Delete(id) {
    $("#delete_id").val(id);
    $("#deleteProductModal").modal("show");
}

$(document).on("click", "#delete_product_btn", function () {
    $("#delete_product_btn").prop("disabled", true);
    $("#delete_product_form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $("#delete_product_form")[0].reset();
                $("#deleteProductModal").modal("hide");
                filterData(productUrl, "product-table");
            }
            $("#delete_product_btn").prop("disabled", false);
        })
        .submit();
});
