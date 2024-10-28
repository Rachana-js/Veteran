function update_order_status(receiving_id, state, user_id) {
    $id = receiving_id;
    $status = state;
    $userid = user_id;
    const select = document.querySelector('#state');
    select.disabled = true;
    if (!confirm("Are you sure?")) {
        return false;

    }
    $.ajax({
        url: "../actions/admin_actions.php",
        type: "post",
        dataType: 'json',
        data: {"orderId": $id, "status": $status, "user_id": $userid, "command": "updateOrderStatus"},

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