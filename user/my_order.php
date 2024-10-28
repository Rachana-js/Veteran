<?php
require_once './session.php';
require_once '../include/config.php';
require_once '../db/DB.php';
require_once '../db/DoctorManager.php';

$myOrder = DoctorManager::getMyOrder($userRid);
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
                        <th class="w-15">Food Name</th>
                        <th>Ordered Date</th>
                        <th>Required Quantity (in  k.g)</th>
                        <th>Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($myOrder as $food) {
                        ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $food['name']; ?></td>
                            <td><?php echo $food['ordered_date']; ?></td>
                            <td><?php echo $food['required_quantity']; ?> k.g</td>
                            <?php
                            echo '';
                            $order_status = $food['order_status'];
                            if ($order_status == 0) {
                                ?>
                                <td style="color: #3366ff"><?php echo "Under Process" ?></td>
                                <?php
                            } else if ($order_status == 1) {
                                ?>
                                <td style="color: #33cc00"><?php echo "Accepted" ?></td>
                                <?php
                            } else if ($order_status == 2) {
                                ?>
                                <td style="color: #ff0000"><?php echo "Rejected" ?></td>
                            <?php }
                            ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <?php require_once '../include/footer.php'; ?>
        <script src="../static/js/order.js"></script>
    </body>
</html>