$(function () {

    // add new disease
    $('#btnAddNewDisease').click(function (evt) {
        evt.preventDefault();
        $('#addDiseaseModal').modal('show');
        $('#formAddDisease')[0].reset();
        $('#diseaseRid').val(0);
    });

    // add new disease mapping
    $('#btnAddNewDiseaseMapping').click(function (evt) {
        evt.preventDefault();
        $('#addDiseaseMap').modal('show');
        $('#formAddDiseaseMap')[0].reset();
    });

    $('#btnSaveDisease').click(function (evt) {
        evt.preventDefault();

        var diseaseName = $('#diseaseName').val();
        var description = $('#description').val();

        if (diseaseName === "") {
            alert("Please enter name");
            return false;
        }

        if (description === "") {
            alert("Please enter description");
            return false;
        }

        $.ajax({
            url: $('#formAddDisease').prop('action'),
            type: $('#formAddDisease').prop('method'),
            data: $('#formAddDisease').serialize(),
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

    // save disease mapping
    $('#btnSaveDiseaseMapping').click(function (evt) {
        evt.preventDefault();

        var animalRid = $('#animalRid').val();
        var disease = document.getElementsByName("diseaseRid[]");

        if (animalRid === "-1") {
            alert("Please select animal");
            return false;
        }

        var atleastOne = false;

        for (var i = 0; i < disease.length; i++) {
            if (disease[i].checked) {
                atleastOne = true;
                break;
            }
        }

        if (!atleastOne) {
            alert("Please select at least one of the diseases");
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

function editDisease(diseaseRid) {
    if (diseaseRid) {
        $.ajax({
            url: '../actions/admin_actions.php',
            type: 'get',
            data: {
                command: 'diseaseDetails',
                diseaseRid: diseaseRid
            },
            success: function (data, textStatus, jqXHR) {

                if (data.success) {

                    var disease = data.body;

                    $('#diseaseRid').val(disease.disease_rid);
                    $('#diseaseName').val(disease.name);
                    $('#description').val(disease.description);
//                    $('#animalImage').val();

                    $('#addDiseaseModal').modal('show');
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

function deleteDisease(diseaseRid) {
    if (diseaseRid) {

        if (!confirm("Are you sure?")) {
            return false;
        }

        $.ajax({
            url: '../actions/admin_actions.php',
            type: 'POST',
            data: {
                command: 'deleteDisease',
                diseaseRid: diseaseRid
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