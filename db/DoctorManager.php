<?php

class DoctorManager {

    public static function getAllDoctors() {
        $sql = "SELECT *,"
                . " DATE_FORMAT(created_at, '%d %M %Y %h:%i %p') AS formatted_date"
                . " FROM doctor"
                . " ORDER BY `name`";
        return DB::selectAll($sql);
    }

    public static function getDoctorDetails($doctorRid) {
        $sql = "SELECT * FROM doctor"
                . " WHERE doctor_rid = $doctorRid AND `status` = 1";
        return DB::selectOne($sql);
    }

    public static function enableDoctor($doctorRid) {
        $sql = "UPDATE doctor SET `status` = 1  WHERE doctor_rid = $doctorRid";
        DB::update($sql);
    }

    public static function disableDoctor($doctorRid) {
        $sql = "UPDATE doctor SET `status` = 0  WHERE doctor_rid = $doctorRid";
        DB::update($sql);
    }

    public static function saveDoctor($doctorRid, $name, $contact, $email, $password, $address) {

        $address = str_replace("'", "\'", $address);

        if ($doctorRid > 0) {
            $sql = "UPDATE doctor SET `name` = '$name' , contact = '$contact' , "
                    . "email = '$email' , address = '$address' , "
                    . "updated_at = NOW()"
                    . " WHERE doctor_rid = '$doctorRid'";
            return DB::update($sql);
        } else {

            if (self::contactAlreadyExists($contact)) {
                throw new Exception("Duplicate contact!");
            }

            if (self::emailAlreadyExists($email)) {
                throw new Exception("Duplicate email!");
            }

            $sql = "INSERT INTO doctor(`name`, contact, email, `password`, address, created_at)"
                    . " VALUES('$name', '$contact', '$email', '$password', '$address', NOW())";
            return DB::insertAndGetId($sql);
        }
    }

    public static function contactAlreadyExists($contact) {
        $sql = "SELECT 1 FROM doctor WHERE contact = '$contact'";
        $res = DB::selectOne($sql);
        return !empty($res);
    }

    public static function emailAlreadyExists($email) {
        $sql = "SELECT 1 FROM doctor WHERE email = '$email'";
        $res = DB::selectOne($sql);
        return !empty($res);
    }

    public static function getFoodDetails() {
        $sql = "SELECT * FROM food"
                . " WHERE `status` = 1 AND `quantity` >0";
        return DB::selectAll($sql);
    }

    public static function getAppointmentsForDoctor($doctorRid, $pending = true) {
        $sql = "SELECT *,"
                . " DATE_FORMAT(a.date_time, '%d %M %Y %h:%i %p') AS appointment_date_time,"
                . " a.status AS appointment_status"
                . " FROM appointment AS a"
                . " JOIN `user` AS u ON (a.user_rid = u.user_rid)"
                . " WHERE a.doctor_rid = $doctorRid";

        if ($pending) {
            $sql .= " AND a.status = 0";
        } else {
            $sql .= " AND a.status = 1";
        }

        $sql .= " ORDER BY a.appointment_rid DESC";

        return DB::selectAll($sql);
    }

    public static function getAppointmentsForUser($userRid) {
        $sql = "SELECT *,"
                . " DATE_FORMAT(a.date_time, '%d %M %Y %h:%i %p') AS appointment_date_time,"
                . " a.status AS appointment_status"
                . " FROM appointment AS a"
                . " JOIN doctor AS d ON (a.doctor_rid = d.doctor_rid)"
                . " WHERE a.user_rid = $userRid"
                . " ORDER BY a.appointment_rid DESC";
        return DB::selectAll($sql);
    }

    public static function saveAppointmentStatus($appointmentRid, $appointmentAction, $rejectReason) {

        $rejectReason = str_replace("'", "\'", $rejectReason);

        $sql = "UPDATE appointment SET `status` = $appointmentAction, reject_reason = '$rejectReason'"
                . " WHERE appointment_rid = $appointmentRid";
        DB::update($sql);
    }

    public static function getMyOrder($userId) {
        $sql = "SELECT * FROM `order` AS o "
                . "JOIN food AS f ON o.food_id=f.food_rid"
                . " WHERE o.user_id='$userId'";
        return DB::selectAll($sql);
    }

}
