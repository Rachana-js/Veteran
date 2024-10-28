<?php
require_once './session.php';
require_once '../include/config.php';
require_once '../include/util.php';
require_once '../db/DB.php';
require_once '../db/AnimalManager.php';
require_once '../db/DiseaseManager.php';
require_once '../db/FoodManager.php';

$animalRid = 0;

if (isset($_GET['id'])) {
    $animalRid = $_GET['id'];
} else {
    echo "Invalid id...";
    die();
}

$animal = AnimalManager::getAnimalDetails($animalRid);

if (empty($animal)) {
    echo "Invalid id...";
    die();
}

$diseases = DiseaseManager::getAnimalDiseaseMapping($animalRid);
$foods = FoodManager::getAnimalFoodMapping($animalRid);
?>

<html>
    <?php require_once '../include/head.php'; ?>

    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container">

            <div class="row">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <img class="img-fluid" src="../uploads/<?php echo $animal['img_url']; ?>"/>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-2">
                                <h4><?php echo $animal['animal_name']; ?></h4>
                                <h6><?php echo $animal['cat_name']; ?></h6>
                                <p class="pr-2"><?php echo $animal['description']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6>Food</h6>
                    </div>
                    <div class="card-body">
                        <?php foreach ($foods as $food) { ?>
                            <div class="row mt-1">
                                <div class="col-md-6">
                                    <img class="img-fluid" src="../uploads/<?php echo $food['img_url']; ?>"/>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <h4><?php echo $food['name']; ?></h4>
                                        <p class="pr-2"><?php echo $food['description']; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6>Diseases</h6>
                    </div>
                    <div class="card-body">
                        <?php foreach ($diseases as $d) { ?>
                            <div class="form-group">
                                <h4><?php echo $d['name']; ?></h4>
                                <p><?php echo $d['description']; ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once '../include/footer.php'; ?>
    </body>
</html>
