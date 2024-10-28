<?php

session_start();

require_once '../include/config.php';
require_once '../include/util.php';
require_once './Response.php';
require_once './../db/DB.php';
require_once './../db/DoctorManager.php';
require_once './../db/LoginManager.php';
require_once './../db/UserManager.php';

$response = new Response();

try {

    if (isset($_GET['command'])) {
        $command = $_GET['command'];
    } else if (isset($_POST['command'])) {
        $command = $_POST['command'];
    } else {
        throw new Exception("Invalid request!");
    }

    if ('login' == $command) {
        $loginId = $_POST['loginId'];
        $password = $_POST['password'];
        $user = LoginManager::login($loginId, $password);

        $_SESSION['is_logged_in'] = true;
        $_SESSION['user'] = $user;

        if (isset($user->is_admin) && $user->is_admin) {
            $data['admin'] = true;
        } else if (isset($user['veteran']) && $user['veteran']) {
            $data['veteran'] = $user;
        } else {
            $data['user'] = $user;
        }

        $response->success($data);
    } else if ('register' == $command) {
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $registrationType = $_POST['registrationType'];

        if (1 == $registrationType) {  // user
            $res = UserManager::saveUser(0, $name, $contact, $email, $password, $address);
        } else { // veteran
            $res = DoctorManager::saveDoctor(0, $name, $contact, $email, $password, $address);
        }

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
