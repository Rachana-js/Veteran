<?php
require_once './session.php';
require_once '../include/config.php';
require_once '../include/util.php';
require_once '../db/DB.php';
require_once '../db/DoctorManager.php';

$appointments = DoctorManager::getAppointmentsForDoctor($doctorRid, false);
?>

<html>
    <?php require_once '../include/head.php'; ?>
    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container-fluid">
            <div class="row">
                <h4 class="p-3">Accepted Appointments</h4>
            </div>
            <table class="table table-bordered table-sm table-condesed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="w-10">Name</th>
                        <th style="width: 15%;">Date & Time</th>
                        <th>Description</th>
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
                            <td><?php echo $a['date_time']; ?></td>
                            <td><?php echo $a['description']; ?></td>
                        </tr>
                        <?php
                    }

                    if ($i == 0) {
                        ?>
                        <tr>
                            <td colspan="100%" class="alert alert-danger text-center">
                                There're no accepted appointments!
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <?php require_once '../include/footer.php'; ?>
        <script src="../static/js/appointments.js"></script>
    </body>
</html>
