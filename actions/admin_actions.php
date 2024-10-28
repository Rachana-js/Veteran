<?php

session_start();

require_once '../include/config.php';
require_once '../include/util.php';
require_once '../include/mailer.php';
require_once './Response.php';
require_once './../db/DB.php';
require_once './../db/AnimalManager.php';
require_once './../db/DiseaseManager.php';
require_once './../db/FoodManager.php';
require_once './../db/UserManager.php';
require_once './../db/DoctorManager.php';
$response = new Response();
$con = new DB();

try {

    if (isset($_GET['command'])) {
        $command = $_GET['command'];
    } else if (isset($_POST['command'])) {
        $command = $_POST['command'];
    } else {
        throw new Exception("Invalid request!");
    }

    if ('saveAnimal' == $command) {

        $animalRid = $_POST['animalRid'];
        $animalName = $_POST['animalName'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $chkUpdateImage = isset($_POST['chkUpdateImage']);

        $res = AnimalManager::saveAnimal($animalRid, $animalName, $category, $description, $chkUpdateImage);

        if ($res > 0) {
            $response->success("Successfully completed!");
        } else {
            throw new Exception("Something went wrong...");
        }
    } else if ('deleteAnimal' == $command) {
        $animalRid = $_POST['animalRid'];
        AnimalManager::deleteAnimal($animalRid);
        $response->success("Successfully completed!");
    } else if ('animalDetails' == $command) {
        $animalRid = $_GET['animalRid'];
        $res = AnimalManager::getAnimalDetails($animalRid);
        $response->success($res);
    } else if ('saveFood' == $command) {
        $foodRid = $_POST['foodRid'];
        $foodName = $_POST['foodName'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $chkUpdateImage = isset($_POST['chkUpdateImage']);

        $res = FoodManager::saveFood($foodRid, $foodName, $description, $quantity, $price, $chkUpdateImage);

        if ($res > 0) {
            $response->success("Successfully completed!");
        } else {
            throw new Exception("Something went wrong...");
        }
    } else if ('deleteFood' == $command) {
        $foodRid = $_POST['foodRid'];
        FoodManager::deleteFood($foodRid);
        $response->success("Successfully completed!");
    } else if ('foodDetails' == $command) {
        $foodRid = $_GET['foodRid'];
        $res = FoodManager::getFoodDetails($foodRid);
        $response->success($res);
    } else if ('saveFoodMap' == $command) {
        $foodRids = $_POST['foodRids'];  // array of food rids
        $animalRid = $_POST['animalRid'];
        FoodManager::saveFoodMaping($foodRids, $animalRid);
        $response->success("Successfully completed!");
    } else if ('getAnimalFoodMapping' == $command) {
        $animalRid = $_GET['animalRid'];
        $res = FoodManager::getAnimalFoodMapping($animalRid);
        $response->success($res);
    } else if ('saveDisease' == $command) {
        $diseaseRid = $_POST['diseaseRid'];
        $diseaseName = $_POST['diseaseName'];
        $description = $_POST['description'];
        $res = DiseaseManager::saveDisease($diseaseRid, $diseaseName, $description);

        if ($res > 0) {
            $response->success("Successfully completed!");
        } else {
            throw new Exception("Something went wrong...");
        }
    } else if ('saveDiseaseMap' == $command) {
        $diseaseRids = $_POST['diseaseRid'];  // array of disease rids
        $animalRid = $_POST['animalRid'];
        DiseaseManager::saveDiseaseMapping($diseaseRids, $animalRid);
        $response->success("Successfully completed!");
    } else if ('diseaseDetails' == $command) {
        $diseaseRid = $_GET['diseaseRid'];
        $res = DiseaseManager::getDiseaseDetails($diseaseRid);
        $response->success($res);
    } else if ('getAnimalDiseaseMapping' == $command) {
        $animalRid = $_GET['animalRid'];
        $res = DiseaseManager::getAnimalDiseaseMapping($animalRid);
        $response->success($res);
    } else if ('disableUser' == $command) {
        $userRid = $_POST['userRid'];
        UserManager::disableUser($userRid);
        $response->success("Successfully completed!");
    } else if ('enableUser' == $command) {
        $userRid = $_POST['userRid'];
        UserManager::enableUser($userRid);
        $response->success("Successfully completed!");
    } else if ('enableDoctor' == $command) {
        $doctorRid = $_POST['doctorRid'];
        DoctorManager::enableDoctor($doctorRid);
        $response->success("Successfully completed!");
    } else if ('disableDoctor' == $command) {
        $doctorRid = $_POST['doctorRid'];
        DoctorManager::disableDoctor($doctorRid);
        $response->success("Successfully completed!");
    } else if ('deleteDisease' == $command) {
        $diseaseRid = $_POST['diseaseRid'];
        DiseaseManager::deleteDisease($diseaseRid);
        $response->success("Successfully completed!");
    } else if ('updateOrderStatus' == $command) {
        $id = $_POST['orderId'];
        $state = $_POST['status'];
        $user_id = $_POST['user_id'];
        $get_food = "SELECT f.name,o.total_cost,required_quantity FROM `order` AS o "
                . "JOIN food AS f ON f.food_rid=o.food_id WHERE o.order_rid= '$id'";
        $re = $con->selectAll($get_food);

        $get_email = "SELECT email,name FROM `user` WHERE user_rid = '$user_id'";
        $resp = $con->selectAll($get_email);

        if ($state === '1' && !empty($resp)) {

            $email_id = $resp[0]['email'];
            $u_name = $resp[0]['name'];
            $f_name = $re[0]['name'];
            $f_price = $re[0]['total_cost'];
            $f_quant = $re[0]['required_quantity'];
            $mailBody = "Hello $u_name,you order for food item $f_name with quantity $f_quant k.g and total price Rs.$f_price/-.";

            $sql = "UPDATE `order` SET order_status = '$state' WHERE order_rid = $id";
            $res = $con->update($sql);
            if ($res > 0) {
                if (sendMail("Order Status", $mailBody, $email_id)) {
                    $response->success("Completed successfully...");
                }
            } else {
                throw new Exception("Something went wrong...");
            }
        } else {
            $sql = "UPDATE `order` SET order_status = '$state' WHERE order_rid = $id";
            $res = $con->update($sql);
            if ($res > 0) {
                $response->success("Completed successfully...");
            } else {
                throw new Exception("Something went wrong...");
            }
        }
    }
} catch (\Exception $ex) {
    $response->error($ex->getMessage());
}

$response->writeResponse();
