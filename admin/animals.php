<?php
require_once '../include/config.php';
require_once '../db/DB.php';
require_once '../db/AnimalManager.php';

$disease = AnimalManager::getCategories();
$animals = AnimalManager::getAllAnimals();
?>

<html>
    <?php require_once '../include/head.php'; ?>
    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container-fluid">

            <div class="row justify-content-end">
                <button class="btn btn-primary btn-sm m-3" id="btnAddNewAnimal">
                    Add New Animal
                </button>
            </div>

            <table class="table table-bordered table-sm table-condesed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="w-15">Name</th>
                        <th class="w-15">Category</th>
                        <th>Description</th>
                        <th class="w-10">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($animals as $d) {
                        ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $d['animal_name']; ?></td>
                            <td><?php echo $d['cat_name']; ?></td>
                            <td><?php echo $d['description']; ?></td>
                            <td>
                                <a href="#" onclick="editAnimal('<?php echo $d['animal_rid']; ?>')">
                                    Edit
                                </a>
                                /
                                <a href="#" onclick="deleteAnimal('<?php echo $d['animal_rid']; ?>')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!--add animal modal-->
        <div class="modal fade" id="addAnimalModal" tabindex="-1" role="dialog"
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
                        <form id="formAddAnimal" action="../actions/admin_actions.php"
                              method="post" enctype="multipart/form-data">
                            <input type="hidden" name="command" value="saveAnimal"/>
                            <input type="hidden" id="animalRid" name="animalRid"/>

                            <div class="form-group">
                                <input type="text" class="form-control" id="animalName" name="animalName"
                                       placeholder="Animal Name" autocomplete="off"/>
                            </div>

                            <div class="form-group">
                                <select class="form-control" id="category" name="category">
                                    <option value="-1">--Select Category--</option>
                                    <?php foreach ($disease as $cat) { ?>
                                        <option value="<?php echo $cat['category_rid']; ?>">
                                            <?php echo $cat['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" id="description"
                                          name="description" placeholder="Description"></textarea>
                            </div>

                            <div class="form-group">
                                <input type="file" class="form-control" id="animalImage" name="animalImage"/>
                            </div>

                            <div id="divChangeImage" class="form-group d-none">
                                <input type="checkbox" id="chkUpdateImage" name="chkUpdateImage" value="true">
                                <label for="chkUpdateImage">Change Image</label>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" id="btnSaveAnimal" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once '../include/footer.php'; ?>
        <script src="../static/js/animal.js"></script>
    </body>
</html>
