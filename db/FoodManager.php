<?php

class FoodManager {

    public static function getFoodList() {
        $sql = "SELECT * FROM food"
                . " WHERE `status` = 1"
                . " ORDER BY `name`";
        return DB::selectAll($sql);
    }

    public static function saveFood($foodRid, $foodName, $description, $quantity, $price, $chkUpdateImage) {

        $foodImage = $chkUpdateImage ? uploadFile('foodImage') : '';

        $foodName = str_replace("'", "\'", $foodName);
        $description = str_replace("'", "\'", $description);

        if ($foodRid > 0) {

            $foodImage = empty($foodImage) ? 'img_url' : "'$foodImage'";

            $sql = "UPDATE food SET `name` = '$foodName' ,"
                    . " description = '$description' ,quantity = '$quantity' ,price = '$price' ,"
                    . " img_url = $foodImage, "
                    . " updated_at = NOW()"
                    . " WHERE food_rid = '$foodRid' ";
            return DB::update($sql);
        } else {

            if (self::isDuplicateFoodName($foodName)) {
                throw new Exception("Duplicate name");
            }

            $sql = "INSERT INTO food(`name`, description,quantity,`price`, img_url, created_at)"
                    . " VALUES('$foodName', '$description','$quantity','$price','$foodImage', NOW())";
            return DB::insertAndGetId($sql);
        }
    }

    public static function deleteFood($foodRid) {
        $sql = "UPDATE food SET `status` = 0 WHERE food_rid = $foodRid";
        return DB::update($sql);
    }

    public static function getFoodDetails($foodRid) {
        $sql = "SELECT *"
                . " FROM food"
                . " WHERE `status` = 1 AND food_rid = $foodRid"
                . " ORDER BY `name` ASC";
        return DB::selectOne($sql);
    }

    public static function saveFoodMaping($foodRids, $animalRid) {

        if (self::alreadyMapped($animalRid)) {
            self::deleteMapping($animalRid);
        }

        $sql = "INSERT INTO food_animal_map(food_rid, animal_rid)"
                . " VALUES";

        for ($i = 0; $i < count($foodRids); $i++) {

            if ($i > 0) {
                $sql .= ", ";
            }

            $sql .= "($foodRids[$i], $animalRid)";
        }

        return DB::insertAndGetId($sql);
    }

    public static function alreadyMapped($animalRid) {
        $sql = "SELECT 1 FROM food_animal_map"
                . " WHERE animal_rid = $animalRid";
        $res = DB::selectOne($sql);
        return !empty($res);
    }

    public static function deleteMapping($animalRid) {
        $sql = "DELETE FROM food_animal_map"
                . " WHERE animal_rid = $animalRid";
        DB::update($sql);
    }

    public static function getAnimalFoodMapping($animalRid) {
        $sql = "SELECT * FROM food_animal_map AS fam"
                . " JOIN food AS f ON (fam.food_rid = f.food_rid)"
                . " WHERE fam.animal_rid = $animalRid";
        return DB::selectAll($sql);
    }

    public static function isDuplicateFoodName($foodName) {
        $sql = "SELECT 1 FROM food WHERE `name` = '$foodName' AND status=1";
        $res = DB::selectOne($sql);
        return !empty($res);
    }

    public static function getAllOrder() {
        $sql = "SELECT f.name AS food_name,u.name,o.required_quantity,"
                . "o.ordered_date,o.order_status,o.order_rid,o.user_id FROM `order` AS o"
                . " JOIN food AS f ON o.food_id=f.food_rid"
                . " JOIN `user` AS u ON u.user_rid=o.user_id"
                . " ORDER BY `ordered_date` ASC";
        return DB::selectAll($sql);
    }

}
