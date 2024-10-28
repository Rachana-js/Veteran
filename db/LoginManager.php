<?php

class LoginManager {

    public static function login($loginId, $password) {

        if (ADMIN_LOGIN_ID == $loginId && ADMIN_PASSWORD == $password) {
            return (object) array(
                        'is_admin' => true,
                        'name' => 'Admin'
            );
        }

        $sql = "SELECT * FROM `user`"
                . " WHERE (contact = '$loginId' OR email = '$loginId')"
                . " AND password = '$password'"
                . " AND `status` = 1";

        $user = DB::selectOne($sql);

        if (!empty($user)) {
            $user['user'] = true;
            return $user;
        }

        $sql = "SELECT * FROM `doctor`"
                . " WHERE (contact = '$loginId' OR email = '$loginId')"
                . " AND password = '$password'"
                . " AND `status` = 1";

        $doctor = DB::selectOne($sql);

        if (!empty($doctor)) {
            $doctor['veteran'] = true;
            return $doctor;
        }

        throw new Exception("Invalid login credentials...");
    }

}
