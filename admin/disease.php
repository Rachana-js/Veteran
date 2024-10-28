<?php
require_once '../include/config.php';
require_once '../db/DB.php';
require_once '../db/AnimalManager.php';
require_once '../db/DiseaseManager.php';

$animals = AnimalManager::getAllAnimals();
$disease = DiseaseManager::getDiseaseList();
?>

<html>
    <?php require_once '../include/head.php'; ?>
    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container-fluid">

            <div class="row justify-content-end mb-2 mt-2">
                <button class="btn btn-primary btn-sm mr-1" id="btnAddNewDisease">
                    Add New Disease
                </button>
                <button class="btn btn-primary btn-sm mr-3" id="btnAddNewDiseaseMapping">
                    Disease Mapping
                </button>
            </div>

            <table class="table table-bordered table-sm table-condesed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="w-10">Name</th>
                        <th>Description</th>
                        <th class="w-10">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($disease as $d) {
                        ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $d['name']; ?></td>
                            <td><?php echo $d['description']; ?></td>
                            <td>
                                <a href="#" onclick="editDisease('<?php echo $d['disease_rid']; ?>')">
                                    Edit
                                </a>
                                /
                                <a href="#" onclick="deleteDisease('<?php echo $d['disease_rid']; ?>')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!--add animal modal-->
        <div class="modal fade" id="addDiseaseModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true"
             data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Disease</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formAddDisease" action="../actions/admin_actions.php" method="post">
                            <input type="hidden" name="command" value="saveDisease"/>
                            <input type="hidden" id="diseaseRid" name="diseaseRid"/>

                            <div class="form-group">
                                <input type="text" class="form-control" id="diseaseName" name="diseaseName"
                                       placeholder="Disease Name" autocomplete="off"/>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" id="description"
                                          name="description" placeholder="Description"></textarea>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" id="btnSaveDisease" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--add mapping-->
        <div class="modal fade" id="addDiseaseMap" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true"
             data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Disease Mapping</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formAddDiseaseMap" action="../actions/admin_actions.php" method="post">
                            <input type="hidden" name="command" value="saveDiseaseMap"/>

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
                                <?php foreach ($disease as $d) { ?>
                                    <input type="checkbox" name="diseaseRid[]" id="disease<?php echo $d['disease_rid']; ?>"
                                           value="<?php echo $d['disease_rid']; ?>">
                                    <label for="disease<?php echo $d['disease_rid']; ?>">
                                        <?php echo $d['name']; ?>
                                    </label>
                                <?php } ?>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" id="btnSaveDiseaseMapping" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once '../include/footer.php'; ?>
        <script src="../static/js/disease.js"></script>
    </body>
</html>