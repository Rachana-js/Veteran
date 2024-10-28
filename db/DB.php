<?php

class DB {

    private static $con = null;

    function __construct() {
        //empty contructor
    }

    function __destruct() {
        self::close();
    }

    public static function getInstance() {
        if (is_null(self::$con)) {

            self::$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            if (mysqli_connect_errno()) {
                throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
            }
        }

        return self::$con;
    }

    public static function close() {
        if (self::$con != null) {
            mysqli_close(self::$con);
            self::$con = null;
        }
    }

    /**
     * use this function if you query returns more than one rows
     * @param type $query
     * @return type row data
     * @throws Exception
     */
    public static function selectAll($query) {
        try {

            if (!($result = mysqli_query(self::getInstance(), $query))) {
                throw new Exception(mysqli_error(self::getInstance()));
            }

            $results_array = array();

            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $results_array[] = $row;
            }

            mysqli_free_result($result);

            return $results_array;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * use this function if your query returns only one row
     * @param type $query
     * @return type row data
     * @throws Exception
     */
    public static function selectOne($query) {
        try {

            if (!($result = mysqli_query(self::getInstance(), $query))) {
                throw new Exception(mysqli_error(self::getInstance()));
            }

            $row = mysqli_fetch_assoc($result);

            mysqli_free_result($result);

            return $row;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function insert($query) {
        try {

            if (!mysqli_query(self::getInstance(), $query)) {
                throw new Exception(mysqli_error(self::getInstance()));
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function update($query) {
        self::insert($query);
        return self::getInstance()->affected_rows;
    }

    public static function insertAndGetId($query) {
        try {

            if (!mysqli_query(self::getInstance(), $query)) {
                throw new Exception(mysqli_error(self::getInstance()));
            }

            return mysqli_insert_id(self::getInstance());
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
