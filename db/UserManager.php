<?php

class UserManager {

    public static function saveUser($userRid, $name, $contact, $email, $password, $address) {

        $address = str_replace("'", "\'", $address);

        if ($userRid > 0) {

            $sql = "UPDATE `user` SET `name` = '$name', contact = '$contact', email = '$email', "
                    . " address = '$address', updated_at = NOW() WHERE user_rid = $userRid";
            return DB::update($sql);
        } else {

            if (self::duplicateContact($contact)) {
                throw new Exception("Duplicate contact!");
            }

            if (self::duplicateEmail($email)) {
                throw new Exception("Duplicate email!");
            }

            $sql = "INSERT INTO `user`(`name`, contact, email, `password`, address, created_at)"
                    . " VALUES('$name', '$contact', '$email', '$password', '$address', NOW())";

            return DB::insertAndGetId($sql);
        }
    }

    public static function duplicateContact($contact) {
        $sql = "SELECT 1 FROM `user` WHERE contact = '$contact'";
        $res = DB::selectOne($sql);
        return !empty($res);
    }

    public static function duplicateEmail($email) {
        $sql = "SELECT 1 FROM `user` WHERE email = '$email'";
        $res = DB::selectOne($sql);
        return !empty($res);
    }

    public static function saveAppointment($userRid, $doctorRid, $datetime, $description) {

        $description = str_replace("'", "\'", $description);

        if (self::isAlreadyAppointed($userRid, $doctorRid, $datetime)) {
            throw new Exception("Appointment has already been taken");
        }

        $sql = "INSERT INTO appointment(user_rid, doctor_rid, date_time, description, created_at)"
                . " VALUES('$userRid', '$doctorRid', '$datetime', '$description', NOW())";
        return DB::insertAndGetId($sql);
    }

    public static function getAllUsers() {
        $sql = "SELECT *,"
                . " DATE_FORMAT(created_at, '%d %M %Y %h:%i %p') AS formatted_date"
                . " FROM `user`"
                . " ORDER BY `name`";
        return DB::selectAll($sql);
    }

    public static function disableUser($userRid) {
        $sql = "UPDATE `user` SET `status` = 0"
                . " WHERE user_rid = $userRid";
        DB::update($sql);
    }

    public static function enableUser($userRid) {
        $sql = "UPDATE `user` SET `status` = 1"
                . " WHERE user_rid = $userRid";
        DB::update($sql);
    }

    public static function isAlreadyAppointed($userRid, $doctorRid, $datetime) {
        $sql = "SELECT 1 FROM appointment"
                . " WHERE date_time = '$datetime' AND user_rid = $userRid AND doctor_rid = $doctorRid";
        $res = DB::selectOne($sql);
        return !empty($res);
    }

}
