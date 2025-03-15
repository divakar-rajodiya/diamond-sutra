$(document).on('click','#change_password_btn',function(){
    $('#change_password_btn').prop('disabled',true);
    $('#change_password_form').ajaxForm(function(res) {
        Toast(res.msg, 3000, res.flag);
        if(res.flag == 1) {
            $('#change_password_form')[0].reset();
        }
      $('#change_password_btn').prop('disabled',false);
    }).submit();
})
$(document).on('click','#save_setting_btn',function(){
    $('#save_setting_btn').prop('disabled',true);
    $('#save_setting_form').ajaxForm(function(res) {
        Toast(res.msg, 3000, res.flag);
        $('#save_setting_btn').prop('disabled',false);
    }).submit();
})