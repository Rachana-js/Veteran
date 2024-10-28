<?php
require_once '../include/config.php';
require_once '../db/DB.php';
require_once '../db/AnimalManager.php';
require_once '../db/FoodManager.php';

$animals = AnimalManager::getAllAnimals();
$foods = FoodManager::getFoodList();
?>

<html>
    <?php require_once '../include/head.php'; ?>
    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container-fluid">

            <div class="row justify-content-end mb-2 mt-2">
                <button class="btn btn-primary btn-sm mr-1" id="btnAddNewFood">
                    Add New Food
                </button>
                <button class="btn btn-primary btn-sm mr-1" id="btnAddFoodMapping">
                    Food Mapping
                </button>
                <a href="./view_order.php" class="btn btn-primary btn-sm mr-3 px-3">
                    View Order
                </a>
            </div>

            <table class="table table-bordered table-sm table-condesed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="w-15">Name</th>
                        <th>Description</th>
                        <th>Quantity (in  k.g)</th>
                        <th>Price (in  R.s)</th>
                        <th class="w-10">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($foods as $food) {
                        ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $food['name']; ?></td>
                            <td><?php echo $food['description']; ?></td>
                            <td><?php echo $food['quantity']; ?> k.g</td>
                            <td>R.s <?php echo $food['price']; ?>/-</td>
                            <td>
                                <a href="#" onclick="editFood('<?php echo $food['food_rid']; ?>')">
                                    Edit
                                </a>
                                /
                                <a href="#" onclick="deleteFood('<?php echo $food['food_rid']; ?>')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!--add animal modal-->
        <div class="modal fade" id="addFoodModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true"
             data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Food</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formAddFood" action="../actions/admin_actions.php"
                              method="post" enctype="multipart/form-data">
                            <input type="hidden" name="command" value="saveFood"/>
                            <input type="hidden" id="foodRid" name="foodRid"/>

                            <div class="form-group">
                                <input type="text" class="form-control" id="foodName" name="foodName"
                                       placeholder="Food Name" autocomplete="off"/>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" id="description"
                                          name="description" placeholder="Description"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                       placeholder="Food Quantity" autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" id="price" name="price"
                                       placeholder="Food Price in Rs" autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control" id="foodImage" name="foodImage"/>
                            </div>

                            <div id="divChangeImage" class="form-group d-none">
                                <input type="checkbox" id="chkUpdateImage" name="chkUpdateImage" value="true">
                                <label for="chkUpdateImage">Change Image</label>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" id="btnSaveFood" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--add mapping-->
        <div class="modal fade" id="addFoodMap" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true"
             data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Food Mapping</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formAddDiseaseMap" action="../actions/admin_actions.php" method="post">
                            <input type="hidden" name="command" value="saveFoodMap"/>

                            <div class="form-group">
                                <select class="form-control" id="animalRid" name="animalRid">
                                    <option value="-1">--Select Animal--</option>
                                    <?php foreach ($animals as $animal) { ?>
                                        <option value="<?php echo $animal['animal_rid']; ?>">
                                            <?php echo $animal['animal_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <?php foreach ($foods as $food) { ?>
                                    <input type="checkbox" name="foodRids[]" id="food<?php echo $food['food_rid']; ?>"
                                           value="<?php echo $food['food_rid']; ?>">
                                    <label for="food<?php echo $food['food_rid']; ?>">
                                        <?php echo $food['name']; ?>
                                    </label>
                                <?php } ?>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" id="btnSaveFoodMapping" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once '../include/footer.php'; ?>
        <script src="../static/js/food.js"></script>
    </body>
</html>