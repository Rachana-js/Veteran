<?php

session_start();

require_once '../include/config.php';
require_once '../include/util.php';
require_once './Response.php';
require_once './../db/DB.php';
require_once './../db/DoctorManager.php';

$response = new Response();

try {

    if (isset($_GET['command'])) {
        $command = $_GET['command'];
    } else if (isset($_POST['command'])) {
        $command = $_POST['command'];
    } else {
        throw new Exception("Invalid request!");
    }

    if ('saveAppointmentStatus' == $command) {
        $appointmentRid = $_POST['appointmentRid'];
        $appointmentAction = $_POST['appointmentAction'];
        $rejectReason = $_POST['rejectReason'];

        DoctorManager::saveAppointmentStatus($appointmentRid, $appointmentAction, $rejectReason);

        $response->success("Completed Successfully!");
    }
} catch (Exception $ex) {
    $response->error($ex->getMessage());
}

$response->writeResponse();
