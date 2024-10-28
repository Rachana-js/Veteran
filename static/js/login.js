$(function () {

    $('#btnLogin').click(function (evt) {
        evt.preventDefault();

        var loginId = $('#loginId').val();
        var password = $('#password').val();

        if (loginId === "") {
            alert("Please enter login id...");
            return false;
        }

        if (password === "") {
            alert("Please enter password...");
            return false;
        }

        $.ajax({
            url: $('#formLogin').prop('action'),
            type: $('#formLogin').prop('method'),
            data: $('#formLogin').serialize(),
            success: function (data, textStatus, jqXHR) {

                if (data.success) {

                    if (data.body.admin) {
                        $('#formAdminLoginRedirect').submit();
                    } else if (data.body.veteran) {
                        $('#formVeteranLoginRedirect').submit();
                    } else {
                        $('#formUserLoginRedirect').submit();
                    }

                } else {
                    alert(data.error);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });

    // register
    $('#btnRegister').click(function (evt) {
        evt.preventDefault();

        var name = $('#name').val();
        var contact = $('#contact').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var address = $('#address').val();

        if (name === "") {
            alert("Please enter name...");
            return false;
        }

        if (contact === "" || contact.length !== 10 || isNaN(contact)) {
            alert("Please enter valid contact number...");
            return false;
        }

        if (email === "") {
            alert("Please enter valid email...");
            return false;
        }
        if (!/(.+)@(.+){2,}\.(.+){2,}/.test(email)) {
            alert("Invalid email address!");
            return false;
        }
        if (password === "") {
            alert("Please enter password...");
            return false;
        }

        if (address === "") {
            alert("Please enter address...");
            return false;
        }

        $.ajax({
            url: $('#formRegistration').prop('action'),
            type: $('#formRegistration').prop('method'),
            data: $('#formRegistration').serialize(),
            success: function (data, textStatus, jqXHR) {

                if (data.success) {

                    alert(data.body);
                    location.reload();

                } else {
                    alert(data.error);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });

});
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}