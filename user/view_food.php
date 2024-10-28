<?php
require_once './session.php';
require_once '../include/config.php';
require_once '../db/DB.php';
require_once '../db/DoctorManager.php';

$food = DoctorManager::getFoodDetails();
?>

<html>
    <?php require_once '../include/head.php'; ?>
    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container-fluid" style="background-image: url('../static/images/1.jpg');background-size: cover;background-position: center;">

            <div class="row justify-content-center ml-3 rounded">
                <?php
                if (!empty($food)) {
                    foreach ($food as $fd) {
                        ?>
                        <div class="col-md-4 mb-3">

                            <div class="card  mt-3" style="width: 18rem;">
                                <img src="../uploads/<?php echo "$fd[img_url]" ?> " class="card-img-top" style="height: 50%;" alt="product image">
                                <div class="card-body align-middle text-center">

                                    <h5 class="card-title"><?php echo $fd['name']; ?></h5>
                                    <h6>Available : <?php echo $fd['quantity']; ?>Kg.</h6>
                                    <h6>Price :Rs.<?php echo $fd['price']; ?>/-</h6>
                                    <p class="card-text"><?php echo $fd['description']; ?></p>

                                    <button id="btnOrder"
                                            onclick="orderFood('<?php echo $fd['food_rid']; ?>', '<?php echo $fd['quantity']; ?>', '<?php echo $fd['price']; ?>')"
                                            class="btn btn-sm btn-primary">
                                        Order
                                    </button>                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>







        <!--order food modal-->
        <div class="modal fade" id="orderFoodModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true"
             data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Order Food</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formSaveOrder" action="../actions/user_actions.php"
                              method="post" >
                            <input type="hidden" name="command" value="saveOrder"/>
                            <input type="hidden" id="foodId" name="foodId" />
                            <input type="hidden" id="foodQuantity" name="foodQuantity" />
                            <input type="hidden" id="foodPrice" name="foodPrice" />
                            <input type="hidden" id="userRid" name="userRid" value="<?php echo $userRid; ?>"/>
                            <div class="form-group">
                                <input type="number" class="form-control" id="required_quant" name="required_quant"
                                       placeholder="Enter Required Quantity" autocomplete="off"/>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" id="btnSaveOrder" class="btn btn-primary">
                                    Order
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once '../include/footer.php'; ?>
        <script src="../static/js/order.js"></script>
    </body>
</html>