$(function () {

    $('#btnAddNewFood').click(function (evt) {
        evt.preventDefault();
        $('#addFoodModal').modal('show');
        $('#formAddFood')[0].reset();
        $('#foodRid').val(0);
    });

    // add new food mapping
    $('#btnAddFoodMapping').click(function (evt) {
        evt.preventDefault();
        $('#addFoodMap').modal('show');
        $('#formAddFoodMap')[0].reset();
    });

    $('#btnSaveFood').click(function (evt) {
        evt.preventDefault();

        var chkUpdateImage = $('#chkUpdateImage').prop('checked');
        var foodRid = $('#foodRid').val();
        var foodName = $('#foodName').val();
        var description = $('#description').val();
        var quantity = $('#quantity').val();
        var price = $('#price').val();
        var foodImage = $('#foodImage').val();

        if (foodName === "") {
            alert("Please enter name");
            return false;
        }

        if (description === "") {
            alert("Please enter description");
            return false;
        }
        if (quantity === "") {
            alert("Please enter food quantity!");
            return false;
        }
        if (price === "") {
            alert("Please enter food price!");
            return false;
        }
        if (foodRid <= 0) {
            $('#chkUpdateImage').prop('checked', true);
        }

        if (foodRid <= 0 && foodImage === "") {
            alert("Please select an image");
            return false;

        }

        if (foodImage === "" && chkUpdateImage) {
            alert("Please select an image");
            return false;
        }

        $.ajax({
            url: $('#formAddFood').prop('action'),
            type: $('#formAddFood').prop('method'),
            contentType: false,
            processData: false,
            data: new FormData($('#formAddFood')[0]),
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

    // save food mapping
    $('#btnSaveFoodMapping').click(function (evt) {
        evt.preventDefault();

        var animalRid = $('#animalRid').val();
        var food = document.getElementsByName("foodRids[]");

        if (animalRid === "-1") {
            alert("Please select animal");
            return false;
        }

        var atleastOne = false;

        for (var i = 0; i < food.length; i++) {
            if (food[i].checked) {
                atleastOne = true;
                break;
            }
        }

        if (!atleastOne) {
            alert("Please select at least one of the foods");
            return false;
        }

        $.ajax({
            url: $('#formAddDiseaseMap').prop('action'),
            type: $('#formAddDiseaseMap').prop('method'),
            data: $('#formAddDiseaseMap').serialize(),
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

function editFood(foodRid) {
    if (foodRid) {
        $.ajax({
            url: '../actions/admin_actions.php',
            type: 'get',
            data: {
                command: 'foodDetails',
                foodRid: foodRid
            },
            success: function (data, textStatus, jqXHR) {

                if (data.success) {

                    var food = data.body;

                    $('#foodRid').val(food.food_rid);
                    $('#foodName').val(food.name);
                    $('#description').val(food.description);
                    $('#quantity').val(food.quantity);
                    $('#price').val(food.price);
                    $('#divChangeImage').removeClass('d-none')

                    $('#addFoodModal').modal('show');
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

function deleteFood(foodRid) {
    if (foodRid) {
        if (!confirm("Are you sure?")) {
            return false;
        }

        $.ajax({
            url: '../actions/admin_actions.php',
            type: 'POST',
            data: {
                command: 'deleteFood',
                foodRid: foodRid
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