<?php

class AnimalManager {

    public static function getCategories() {
        $sql = "SELECT * FROM category"
                . " WHERE `status` = 1"
                . " ORDER BY `name`";
        return DB::selectAll($sql);
    }

    public static function getAllAnimals() {
        $sql = "SELECT *,"
                . " a.name AS animal_name,"
                . " cat.name AS cat_name"
                . " FROM animal AS a"
                . " JOIN category AS cat ON (a.category_rid = cat.category_rid)"
                . " WHERE a.status = 1"
                . " ORDER BY a.name ASC";
        return DB::selectAll($sql);
    }

    public static function saveAnimal($animalRid, $animalName, $category, $description, $chkUpdateImage) {

        $animalName = str_replace("'", "\'", $animalName);
        $description = str_replace("'", "\'", $description);

        $animalImage = $chkUpdateImage ? uploadFile('animalImage') : '';

        if ($animalRid > 0) {

            $animalImage = empty($animalImage) ? 'img_url' : "'$animalImage'";

            $sql = "UPDATE animal SET `name` = '$animalName' ,"
                    . " category_rid = '$category' , description = '$description' ,"
                    . " img_url = $animalImage , updated_at = NOW()"
                    . " WHERE animal_rid = '$animalRid' ";
            return DB::update($sql);
        } else {

            if (self::isDuplicateAnimalName($animalName)) {
                throw new Exception("Duplicate name");
            }

            $sql = "INSERT INTO animal(`name`, category_rid, description, img_url, created_at)"
                    . " VALUES('$animalName', '$category', '$description', '$animalImage', NOW())";
            return DB::insertAndGetId($sql);
        }
    }

    public static function deleteAnimal($animalRid) {
        $sql = "UPDATE animal SET `status` = 0 WHERE animal_rid = $animalRid";
        return DB::update($sql);
    }

    public static function getAnimalDetails($animalRid) {
        $sql = "SELECT *,"
                . " a.name AS animal_name,"
                . " cat.name AS cat_name"
                . " FROM animal AS a"
                . " JOIN category AS cat ON (a.category_rid = cat.category_rid)"
                . " WHERE a.status = 1 AND a.animal_rid = $animalRid"
                . " ORDER BY a.name ASC";
        return DB::selectOne($sql);
    }

    public static function isDuplicateAnimalName($animalName) {
        $sql = "SELECT 1 FROM animal WHERE `name` = '$animalName' AND status=1";
        $res = DB::selectOne($sql);
        return !empty($res);
    }

}
