$(function() {

    $("#login").submit(function(e){
        var form = $(this);
        $.ajax({
            url  :  form.attr('action'),
            type :  form.attr('method'),
            data :  form.serialize(),
            success: function(response){
                if(response != 'true'){
                    alert(response);
                }else{
                    $.post('UserPage.php', this.data);
                    window.location.href = 'UserPage.php';
                }
            }
        });
        return false;
    });

});