$(document).ready(function(){
    filterData(subCategoryListUrl,'subcategory-table');
})


$(document).on("click", "#add_subcategory_modal", function () {
    $("#addSubCategoryModal").modal("show");
});
$(document).on("click", "#add_subcategory_btn", function () {
    $("#add_subcategory_btn").prop("disabled", true);
    $("#add_subcategory_form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $("#add_subcategory_form")[0].reset();
                $("#addSubCategoryModal").modal("hide");
                filterData(subCategoryListUrl, "subcategory-table");
            }
            $("#add_subcategory_btn").prop("disabled", false);
        })
        .submit();
});


function edit(id, category_id, name) {
    $("#update_id").val(id);
    $("#update_subcategory_name").val(name);
    console.log(category_id);
    $('#update_category>option[value="'+category_id+'"]').prop('selected', true);
    $("#editSubCategoryModal").modal("show");
}

$(document).on("click", "#update_subcategory_btn", function () {
    $("#update_subcategory_btn").prop("disabled", true);
    $("#update_subcategory_form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $("#update_subcategory_form")[0].reset();
                $("#editSubCategoryModal").modal("hide");
                filterData(subCategoryListUrl, "subcategory-table");
            }
            $("#update_subcategory_btn").prop("disabled", false);
        })
        .submit();
});

function Delete(id) {
    $("#delete_id").val(id);
    $("#deleteSubCategoryModal").modal("show");
}

$(document).on("click", "#delete_subcategory_btn", function () {
    $("#delete_subcategory_btn").prop("disabled", true);
    $("#delete_subcategory_form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $("#delete_subcategory_form")[0].reset();
                $("#deleteSubCategoryModal").modal("hide");
                filterData(subCategoryListUrl, "subcategory-table");
            }
            $("#delete_subcategory_btn").prop("disabled", false);
        })
        .submit();
});



