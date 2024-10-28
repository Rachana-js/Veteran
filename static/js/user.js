$(function () {

    //

});

function disableUser(userRid) {
    if (userRid) {

        if (!confirm("Are you sure?")) {
            return false;
        }

        $.ajax({
            url: "../actions/admin_actions.php",
            type: 'POST',
            data: {
                command: 'disableUser',
                userRid: userRid
            },
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

    }
}
function enableUser(userRid) {
    if (userRid) {

        if (!confirm("Are you sure?")) {
            return false;
        }

        $.ajax({
            url: "../actions/admin_actions.php",
            type: 'POST',
            data: {
                command: 'enableUser',
                userRid: userRid
            },
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

    }
}