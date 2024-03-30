$(document).ready(function(){
    $('#new-pass').focus(function(){
        var old_pass = $('#pass-old').val();
        var username = $('#account').html();
        var data = {username:username, old_pass:old_pass};
        $.ajax({
            type: "POST",
            url: "?mod=users&action=ajax_confirm_pass",
            data: data,
            dataType: "text",
            success: function (response) {
                $('#old-pass-error').html(response);
            }
        });
    })
    $('#upload-thumb').change(function(){
        console.log($(this).val())
    })
})
