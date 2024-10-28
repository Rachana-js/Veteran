<?php
require_once '../include/config.php';
require_once '../db/DB.php';
require_once '../db/UserManager.php';

$users = UserManager::getAllUsers();
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
                    foreach ($users as $u) {
                        ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $u['name']; ?></td>
                            <td><?php echo $u['contact']; ?></td>
                            <td><?php echo $u['email']; ?></td>
                            <td><?php echo $u['address']; ?></td>
                            <td><?php echo $u['formatted_date']; ?></td>
                            <td>
                                <?php
                                $state = $u['status'];
                                if ($state == 0) {
                                    ?>
                                    <a href="#" onclick="enableUser('<?php echo $u['user_rid']; ?>')">
                                        Enable
                                    </a>
                                <?php } else { ?>
                                    <a href="#" onclick="disableUser('<?php echo $u['user_rid']; ?>')">
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
        <script src="../static/js/user.js"></script>
    </body>
</html>