$(function () {

    // when action drop down changes, enable/disable text area
    $('#appointmentAction').change(function (evt) {

        var action = $('#appointmentAction').val();

        if (action === "-1") {
            $('#rejectReasonDiv').removeClass('d-none');
        } else {
            $('#rejectReason').val("");
            $('#rejectReasonDiv').addClass('d-none');
        }
    });

    $('#btnSaveAppointmentStatus').click(function (evt) {
        evt.preventDefault();

        var appointmentAction = $('#appointmentAction').val();
        var rejectReason = $('#rejectReason').val();

        if (appointmentAction === "0") {
            alert("Please select an action");
            return false;
        }

        if (appointmentAction === "-1" && rejectReason === "") {
            alert("Please enter reason for rejection");
            return false;
        }

        $.ajax({
            url: $('#formAppointmentAction').prop('action'),
            type: $('#formAppointmentAction').prop('method'),
            data: $('#formAppointmentAction').serialize(),
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

function takeAction(appointmentRid) {
    if (appointmentRid) {
        $('#formAppointmentAction')[0].reset();
        $('#appointmentRid').val(appointmentRid);
        $('#appointmentActionModal').modal('show');
    }
}