<?php
require_once './session.php';
require_once '../include/config.php';
require_once '../include/util.php';
require_once '../db/DB.php';
require_once '../db/DoctorManager.php';

$appointments = DoctorManager::getAppointmentsForDoctor($doctorRid, true);
?>

<html>
    <?php require_once '../include/head.php'; ?>
    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container-fluid">
            <div class="row">
                <h4 class="p-3">Pending Appointments</h4>
            </div>
            <table class="table table-bordered table-sm table-condesed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="w-10">Name</th>
                        <th style="width: 15%;">Date & Time</th>
                        <th>Description</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($appointments as $a) {
                        ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $a['name']; ?></td>
                            <td><?php echo $a['appointment_date_time']; ?></td>
                            <td><?php echo $a['description']; ?></td>
                            <td>
                                <a href="#" onclick="takeAction('<?php echo $a['appointment_rid']; ?>')">
                                    Take Action
                                </a>
                            </td>
                        </tr>
                        <?php
                    }

                    if ($i == 0) {
                        ?>
                        <tr>
                            <td colspan="100%" class="alert alert-danger text-center">
                                No pending appointments
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- appointment action modal-->
        <div class="modal fade" id="appointmentActionModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true"
             data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Animal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formAppointmentAction" action="../actions/doctor_actions.php"
                              method="post">
                            <input type="hidden" name="command" value="saveAppointmentStatus"/>
                            <input type="hidden" id="appointmentRid" name="appointmentRid"/>

                            <div class="form-group">
                                <select class="form-control" id="appointmentAction" name="appointmentAction">
                                    <option value="0">--Select an action--</option>
                                    <option value="1">Accept</option>
                                    <option value="-1">Reject</option>
                                </select>
                            </div>

                            <div id="rejectReasonDiv" class="form-group d-none">
                                <textarea class="form-control" id="rejectReason"
                                          name="rejectReason" placeholder="Reason for rejection"></textarea>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" id="btnSaveAppointmentStatus" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once '../include/footer.php'; ?>
        <script src="../static/js/appointments.js"></script>
    </body>
</html>