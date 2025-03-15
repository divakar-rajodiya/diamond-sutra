$(document).on('click','#upload-csv-btn',function(){
    $('#upload-csv-btn').prop('disabled',true);
    $('#upload-csv-form').ajaxForm(function(res) {
        Toast(res.msg, 3000, res.flag);
        if(res.flag == 1) {
            $('#upload-csv-form')[0].reset();
            filters.itemPerPage = 10;
            filterData(pincodeUrl,'pincode-table');
        }
      $('#upload-csv-btn').prop('disabled',false);
    }).submit();
})

$(document).ready(function(){
    filters.itemPerPage = 10;
    filterData(pincodeUrl,'pincode-table');
})

function Delete(id) {
    $("#delete_id").val(id);
    $("#deletePincodeModal").modal("show");
}

$(document).on("click", "#delete_pincode_btn", function () {
    $("#delete_pincode_btn").prop("disabled", true);
    $("#delete_pincode_form")
        .ajaxForm(function (res) {
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $("#delete_pincode_form")[0].reset();
                $("#deletePincodeModal").modal("hide");
                filterData(pincodeUrl, "pincode-table");
            }
            $("#delete_pincode_btn").prop("disabled", false);
        })
        .submit();
});
