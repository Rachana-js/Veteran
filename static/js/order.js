function orderFood(foodId, foodQuantity, price) {
    if (foodId && foodQuantity && price) {
        $('#formSaveOrder')[0].reset();
        $('#orderFoodModal').modal('show');
        $('#foodId').val(foodId);
        $('#foodQuantity').val(foodQuantity);
        $('#foodPrice').val(price);
    }
}
$(function () {


    $('#btnSaveOrder').click(function (evt) {
        evt.preventDefault();

        var required_quant = $('#required_quant').val();




        if (required_quant === "") {
            alert("Please enter required quantity!");
            return false;
        }

        $.ajax({
            url: $('#formSaveOrder').prop('action'),
            type: $('#formSaveOrder').prop('method'),
            data: $('#formSaveOrder').serialize(),
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

