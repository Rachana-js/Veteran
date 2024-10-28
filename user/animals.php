<?php
require_once './session.php';
require_once '../include/config.php';
require_once '../include/util.php';
require_once '../db/DB.php';
require_once '../db/AnimalManager.php';

$animals = AnimalManager::getAllAnimals();
?>

<html>

    <?php require_once '../include/head.php'; ?>

    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container-fluid" style="background-image: url('../static/images/1.jpg');background-size: cover;background-position: center;">
            <div class="row">
                <?php foreach ($animals as $animal) { ?>
                    <div class="col-md-3">
                        <div class="card mt-2" style="width: 18rem;">
                            <img src="../uploads/<?php echo $animal['img_url']; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $animal['animal_name']; ?></h5>
                                <h6 class="card-subtitle"><?php echo $animal['cat_name']; ?></h6>
                                <p class="card-text"><?php echo trimText($animal['description'], 150); ?></p>
                                <a href="animal_details.php?id=<?php echo $animal['animal_rid']; ?>" class="btn btn-link">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php require_once '../include/footer.php'; ?>
    </body>

</html>
