$(function () {

    $('#btnAddNewAnimal').click(function (evt) {
        evt.preventDefault();
        $('#addAnimalModal').modal('show');
        $('#formAddAnimal')[0].reset();
        $('#animalRid').val(0);
    });

    $('#btnSaveAnimal').click(function (evt) {
        evt.preventDefault();

        var chkUpdateImage = $('#chkUpdateImage').prop('checked');
        var animalRid = $('#animalRid').val();
        var animalName = $('#animalName').val();
        var category = $('#category').val();
        var description = $('#description').val();
        var animalImage = $('#animalImage').val();

        if (animalName === "") {
            alert("Please enter name");
            return false;
        }

        if (category === "-1") {
            alert("Please select category");
            return false;
        }

        if (description === "") {
            alert("Please enter description");
            return false;
        }


        if (animalRid <= 0) {
            $('#chkUpdateImage').prop('checked', true);
        }

        if (animalRid <= 0 && animalImage === "") {
            alert("Please select an image");
            return false;
        }

        if (animalImage === "" && chkUpdateImage) {
            alert("Please select an image");
            return false;
        }

        $.ajax({
            url: $('#formAddAnimal').prop('action'),
            type: $('#formAddAnimal').prop('method'),
            contentType: false,
            processData: false,
            data: new FormData($('#formAddAnimal')[0]),
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

function editAnimal(animalRid) {
    if (animalRid) {
        $.ajax({
            url: '../actions/admin_actions.php',
            type: 'get',
            data: {
                command: 'animalDetails',
                animalRid: animalRid
            },
            success: function (data, textStatus, jqXHR) {

                if (data.success) {

                    var animal = data.body;

                    $('#animalRid').val(animal.animal_rid);
                    $('#animalName').val(animal.animal_name);
                    $('#category').val(animal.category_rid);
                    $('#description').val(animal.description);
                    $('#divChangeImage').removeClass('d-none');

                    $('#addAnimalModal').modal('show');
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


function deleteAnimal(animalRid) {
    if (animalRid) {

        if (!confirm("Are you sure?")) {
            return false;
        }

        $.ajax({
            url: '../actions/admin_actions.php',
            type: 'POST',
            data: {
                command: 'deleteAnimal',
                animalRid: animalRid
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