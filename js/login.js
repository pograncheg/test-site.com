

$("document").ready(function() {

    $("#auth").on("submit", function(event) {

        event.preventDefault();

        $(".error").html('');

        // $.post("/handler.php", {login: $('#login').val(), email: $('#email').val(),name: $('#name').val() });

        // $.post("../controllers/login.php", $(this).serialize(), function (response) {
        $.post("../handlers/login-handler.php", $(this).serialize(), function (response) {

                // window.location.href = '../views/profile.tpl.php';
                console.log(response['status']);
            if(!response['status'])
            {
            $.each(response['errors'], function (field, error){

                console.log("#" + field);

                $("#" + field).next().append('<span>' + error +'</span><br>');

            })                
            } else {
                // console.log('12334');
                window.location.href = '/';
            }
        }, 'json');

    })
})