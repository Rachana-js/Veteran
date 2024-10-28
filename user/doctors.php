<?php
require_once './session.php';
require_once '../include/config.php';
require_once '../db/DB.php';
require_once '../db/DoctorManager.php';

$disease = DoctorManager::getAllDoctors();
?>

<html>
    <?php require_once '../include/head.php'; ?>
    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container">
            <div class="row">
                <?php
                foreach ($disease as $d) {
                    ?>
                    <div class="col-md-3 m-1">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $d['name']; ?></h5>
                                <p class="card-text"><?php echo $d['contact']; ?></p>
                                <p class="card-text"><?php echo $d['address']; ?></p>
                                <button id="btnTakeAppointment"
                                        onclick="takeAppointment('<?php echo $d['doctor_rid']; ?>')"
                                        class="btn btn-link">
                                    Take Appointment
                                </button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!--add animal modal-->
        <div class="modal fade" id="takeAppointmentModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true"
             data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Appointment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formTakeAppointment" action="../actions/user_actions.php"
                              method="post" >
                            <input type="hidden" name="command" value="saveAppointmentFromUser"/>
                            <input type="hidden" id="userRid" name="userRid" value="<?php echo $userRid; ?>"/>
                            <input type="hidden" id="doctorRid" name="doctorRid"/>

                            <div class="form-group">
                                <input type="text" class="form-control" id="appointmentDate" name="appointmentDate"
                                       placeholder="Date" autocomplete="off"/>
                            </div>

                            <div class="form-group">
                                <select class="form-control" id="appointmentTime" name="appointmentTime">
                                    <option value="-1">--Select Time--</option>
                                    <option value="09:00">09:00 AM</option>
                                    <option value="09:30">09:30 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="10:30">10:30 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="11:30">11:30 AM</option>
                                    <option value="12:00">12:00 PM</option>
                                    <option value="12:30">12:30 PM</option>
                                    <option value="01:00">01:00 PM</option>
                                    <option value="01:30">01:30 PM</option>
                                    <option value="02:00">02:00 PM</option>
                                    <option value="02:30">02:30 PM</option>
                                    <option value="03:00">03:00 PM</option>
                                    <option value="03:30">03:30 PM</option>
                                    <option value="04:00">04:00 PM</option>
                                    <option value="04:30">04:30 PM</option>
                                    <option value="05:00">05:00 PM</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" id="description"
                                          name="description" placeholder="Description"></textarea>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" id="btnSaveAppointment" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once '../include/footer.php'; ?>
        <script src="../static/js/doctor.js"></script>
    </body>
</html>