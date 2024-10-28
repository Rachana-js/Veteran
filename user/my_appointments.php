<?php
require_once './session.php';
require_once '../include/config.php';
require_once '../db/DB.php';
require_once '../db/DoctorManager.php';

$appointments = DoctorManager::getAppointmentsForUser($userRid);
?>

<html>
    <?php require_once '../include/head.php'; ?>
    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container">
            <div class="row ml-auto">
                <h5>My Appointments</h5>
            </div>
            <div class="row">
                <?php foreach ($appointments as $appointment) { ?>
                    <div class="col-md-12">

                        <?php
                        $alertColor = "secondary";  // draft
                        $statusText = "DRAFT";  // draft
                        $status = $appointment['appointment_status'];

                        if (1 == $status) {  // accepted
                            $alertColor = "success";
                            $statusText = "confirmed";  // confirm
                        } else if (-1 == $status) {  // rejected
                            $alertColor = "danger";
                            $statusText = "cancelled";  // cancelled
                        }
                        ?>

                        <div class="alert alert-<?php echo $alertColor; ?>" role="alert">
                            Your appointment on
                            <span class="alert-link"><?php echo $appointment['appointment_date_time']; ?></span>

                            <?php if (0 == $status) { ?>
                                is in  <?php echo $statusText; ?> mode.
                            <?php } else { ?>

                                has been

                                <?php echo $statusText; ?>

                                by <span class="alert-link"><?php echo $appointment['name']; ?></span>

                                <?php if (-1 == $status) { ?>
                                    for the following reason: <span class="alert-link"><?php echo $appointment['reject_reason']; ?></span>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php require_once '../include/footer.php'; ?>
        <script src="../static/js/appointments.js"></script>
    </body>
</html>