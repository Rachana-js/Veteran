<?php
require_once '../include/config.php';
require_once '../db/DB.php';
require_once '../db/AnimalManager.php';
require_once '../db/FoodManager.php';

$order_details = FoodManager::getAllOrder();
?>

<html>
    <?php require_once '../include/head.php'; ?>
    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container-fluid">

            <div class="row justify-content-end mb-2 mt-2">
                <!--                <button class="btn btn-primary btn-sm mr-1" id="btnAddNewFood">
                                    Add New Food
                                </button>
                                <button class="btn btn-primary btn-sm mr-1" id="btnAddFoodMapping">
                                    Food Mapping
                                </button>-->
                <a href="./view_order.php" class="btn btn-primary btn-sm mr-3 px-3">
                    View Order
                </a>
            </div>
            <div class="row ml-auto">
                <h5>Order Details</h5>
            </div>
            <table class="table table-bordered table-sm table-condesed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="w-8">Food Name</th>
                        <th class="w-8">User Name</th>
                        <th class="w-8">Quantity(in K.G)</th>
                        <th>Ordered Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($order_details as $order) {
                        ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $order['food_name']; ?></td>
                            <td><?php echo $order['name']; ?></td>
                            <td><?php echo $order['required_quantity']; ?> k.g</td>
                            <td><?php echo $order['ordered_date']; ?></td>
                            <td>
                                <select id="state" name="state" class="form-control alert-primary my-1 form-control-md"
                                        onchange="update_order_status(<?php echo "$order[order_rid]" ?>,<?php echo "$(this).val()" ?>,<?php echo "$order[user_id]" ?>);">

                                    <?php
                                    echo '';
                                    $order_status = $order['order_status'];
                                    if ($order_status == 0) {
                                        ?>
                                        <option value="0" selected>Under Process</option>
                                    <?php } else {
                                        ?>
                                        <option value="0">Under Process</option>
                                        <?php
                                    }

                                    if ($order_status == 1) {
                                        ?>
                                        <option value="1" selected>Accepted</option>
                                    <?php } else {
                                        ?>
                                        <option value="1">Accepted</option>
                                    <?php }
                                    ?>

                                    <?php if ($order_status == 2) { ?>
                                        <option value="2" selected>Rejected</option>
                                    <?php } else {
                                        ?>
                                        <option value="2">Rejected</option>
                                    <?php }
                                    ?>

                                </select>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


        <?php require_once '../include/footer.php'; ?>
        <script src="../static/js/order_action.js"></script>

    </body>
</html>