<?php
require_once '../include/config.php';
require_once '../db/DB.php';
require_once '../db/DoctorManager.php';

$doctors = DoctorManager::getAllDoctors();
?>

<html>
    <?php require_once '../include/head.php'; ?>
    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container-fluid">
            <table class="table table-bordered table-sm table-condesed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th style="width: 15%">Date & Time</th>
                        <th style="width: 5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($doctors as $d) {
                        ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $d['name']; ?></td>
                            <td><?php echo $d['contact']; ?></td>
                            <td><?php echo $d['email']; ?></td>
                            <td><?php echo $d['address']; ?></td>
                            <td><?php echo $d['formatted_date']; ?></td>
                            <td>
                                <?php
                                $state = $d['status'];
                                if ($state == 0) {
                                    ?>
                                    <a href="#" onclick="enableDoctor('<?php echo $d['doctor_rid']; ?>')">
                                        Enable
                                    </a>
                                <?php } else { ?>
                                    <a href="#" onclick="disableDoctor('<?php echo $d['doctor_rid']; ?>')">
                                        Disable
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <?php require_once '../include/footer.php'; ?>
        <script src="../static/js/doctor.js"></script>
    </body>
</html>