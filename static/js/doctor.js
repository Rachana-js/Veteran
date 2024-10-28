$(function () {

    $('#appointmentDate').datepicker({
        dateFormat: 'dd/mm/yy',
        minDate: 0,
        maxDate: '30d'
    });

    // save appointment (user)
    $('#btnSaveAppointment').click(function (evt) {
        evt.preventDefault();

        var appointmentDate = $('#appointmentDate').val();
        var appointmentTime = $('#appointmentTime').val();
        var description = $('#description').val();

        if (appointmentDate === "") {
            alert("Please enter date");
            return false;
        }

        if (appointmentTime === "-1") {
            alert("Please select time");
            return false;
        }

        if (description === "") {
            alert("Please enter description");
            return false;
        }

        $.ajax({
            url: $('#formTakeAppointment').prop('action'),
            type: $('#formTakeAppointment').prop('method'),
            data: $('#formTakeAppointment').serialize(),
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

function enableDoctor(doctorRid) {
    if (doctorRid) {

        if (!confirm("Are you sure?")) {
            return false;
        }

        $.ajax({
            url: '../actions/admin_actions.php',
            type: 'POST',
            data: {
                command: 'enableDoctor',
                doctorRid: doctorRid
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
function disableDoctor(doctorRid) {
    if (doctorRid) {

        if (!confirm("Are you sure?")) {
            return false;
        }

        $.ajax({
            url: '../actions/admin_actions.php',
            type: 'POST',
            data: {
                command: 'disableDoctor',
                doctorRid: doctorRid
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

function takeAppointment(doctorRid) {
    if (doctorRid) {
        $('#formTakeAppointment')[0].reset();
        $('#takeAppointmentModal').modal('show');
        $('#doctorRid').val(doctorRid);
    }
}