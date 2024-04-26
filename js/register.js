
$("document").ready(function() {

    $("#reg").on("submit", function(event) {

        event.preventDefault();

        $(".error").html('');

        $.post("../handlers/register-handler.php", $(this).serialize(), function (response) {
            console.log(response['status']);
            if(!response['status']){
                $.each(response['errors'], function (field, errors){
                    $("#" + field).next().append(errors.map(function(error) {
                        return '<span>' + error +'</span><br>'
                    }).join(''));
                })                
            } else {
                console.log(response['status']);
                window.location.href = '../views/login.php';
            }
        }, 'json');
    })
})