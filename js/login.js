

$("document").ready(function() {

    $("#auth").on("submit", function(event) {

        event.preventDefault();

        $(".error").html('');

        $.post("../handlers/login-handler.php", $(this).serialize(), function (response) {

            if(!response['status']){
            $.each(response['errors'], function (field, error){
                
                $("#" + field).next().append('<span>' + error +'</span><br>');

            })                
            } else {
                window.location.href = '/';
            }
        }, 'json');

    })
})