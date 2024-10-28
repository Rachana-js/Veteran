<?php

session_start();

require_once '../include/config.php';
require_once '../include/util.php';
require_once './Response.php';
require_once './../db/DB.php';
require_once './../db/UserManager.php';

$response = new Response();
$con = new DB();
try {

    if (isset($_GET['command'])) {
        $command = $_GET['command'];
    } else if (isset($_POST['command'])) {
        $command = $_POST['command'];
        if ('saveOrder' == $command) {

            $foodId = $_POST['foodId'];
            $food_quantity = $_POST['foodQuantity'];
            $required_quant = $_POST['required_quant'];
            $ordered_date = date("Y-m-d");
            $userRid = $_POST['userRid'];
            $foodPrice = $_POST['foodPrice'];
            $total_cost = $required_quant * $foodPrice;
            $total_quantity = $food_quantity - $required_quant;
            $sql1 = "SELECT * FROM `food` WHERE NOT quantity <'$required_quant' AND food_rid='$foodId'";
            $quantity = $con->selectOne($sql1);
            if (!empty($quantity)) {
                $sql = "INSERT INTO `order`(food_id,user_id,ordered_date,required_quantity,total_cost)"
                        . "VALUES ('$foodId','$userRid','$ordered_date','$required_quant','$total_cost')";
                $res = $con->insertAndGetId($sql);
                if ($res > 0) {

                    $sql_update = "UPDATE `food` "
                            . "SET food.quantity='$total_quantity' WHERE food_rid='$foodId'";
                    $res = $con->update($sql_update);
                    if (!empty($res)) {
                        $response->success("Successfully Ordered!");
                    } else {
                        $response->error("Something went wrong!");
                    }
                } else {

                    $response->error("Something went wrong!");
                }
            } else {
                $response->error("Required quantity not available!");
            }
        }
    } else {
        throw new Exception("Invalid request!");
    }

    if ('saveAppointmentFromUser' == $command) {
        $userRid = $_POST['userRid'];
        $doctorRid = $_POST['doctorRid'];
        $appointmentDate = $_POST['appointmentDate'];
        $appointmentTime = $_POST['appointmentTime'];

        $appointmentDate = implode("-", array_reverse(explode("/", $appointmentDate)));

        $datetime = $appointmentDate . " " . $appointmentTime;

        $description = $_POST['description'];

        $res = UserManager::saveAppointment($userRid, $doctorRid, $datetime, $description);

        if ($res > 0) {
            $response->success("Completed Successfully!");
        } else {
            $response->success("Something went wrong");
        }
    }
} catch (Exception $ex) {
    $response->error($ex->getMessage());
}

$response->writeResponse();
