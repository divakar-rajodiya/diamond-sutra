$(document).ready(function () {
    filterData(categoryListUrl, "category-table");
});

$(document).on("click", "#add_category_modal", function () {
    $("#addCategoryModal").modal("show");
});
$(document).on("click", "#add_category_btn", function () {
    $("#add_category_btn").prop("disabled", true);
    $("#add_category_form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $("#add_category_form")[0].reset();
                $("#addCategoryModal").modal("hide");
                filterData(categoryListUrl, "category-table");
            }
            $("#add_category_btn").prop("disabled", false);
        })
        .submit();
});


function edit(id, name, status) {
    $("#update_id").val(id);
    $("#update_category_name").val(name);
    $("#update_category_status").prop("checked", false);
    if (status) $("#update_category_status").prop("checked", true);
    $("#editCategoryModal").modal("show");
}

$(document).on("click", "#update_category_btn", function () {
    $("#update_category_btn").prop("disabled", true);
    $("#update_category_form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $("#update_category_form")[0].reset();
                $("#editCategoryModal").modal("hide");
                filterData(categoryListUrl, "category-table");
            }
            $("#update_category_btn").prop("disabled", false);
        })
        .submit();
});

function Delete(id) {
    $("#delete_id").val(id);
    $("#deleteCategoryModal").modal("show");
}

$(document).on("click", "#delete_category_btn", function () {
    $("#delete_category_btn").prop("disabled", true);
    $("#delete_category_form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $("#delete_category_form")[0].reset();
                $("#deleteCategoryModal").modal("hide");
                filterData(categoryListUrl, "category-table");
            }
            $("#delete_category_btn").prop("disabled", false);
        })
        .submit();
});
