<?php

class DiseaseManager {

    public static function getDiseaseList() {
        $sql = "SELECT * FROM disease"
                . " WHERE `status` = 1"
                . " ORDER BY `name`";
        return DB::selectAll($sql);
    }

    public static function saveDisease($diseaseRid, $diseaseName, $description) {

        $diseaseName = str_replace("'", "\'", $diseaseName);
        $description = str_replace("'", "\'", $description);

        if ($diseaseRid > 0) {
            $sql = "UPDATE disease SET `name` = '$diseaseName' ,"
                    . " description = '$description' ,"
                    . " updated_at = NOW()"
                    . " WHERE disease_rid = '$diseaseRid' ";
            return DB::update($sql);
        } else {

            if (self::isDuplicateDiseaseName($diseaseName)) {
                throw new Exception("Duplicate name");
            }

            $sql = "INSERT INTO disease(`name`, description, created_at)"
                    . " VALUES('$diseaseName', '$description', NOW())";
            return DB::insertAndGetId($sql);
        }
    }

    public static function deleteDisease($diseaseRid) {
        $sql = "UPDATE disease SET `status` = 0 WHERE disease_rid = $diseaseRid";
        return DB::update($sql);
    }

    public static function getDiseaseDetails($diseaseRid) {
        $sql = "SELECT *"
                . " FROM disease"
                . " WHERE `status` = 1 AND disease_rid = $diseaseRid"
                . " ORDER BY `name` ASC";
        return DB::selectOne($sql);
    }

    public static function saveDiseaseMapping($diseaseRids, $animalRid) {

        if (self::alreadyMapped($animalRid)) {
            self::deleteMapping($animalRid);
        }

        $sql = "INSERT INTO disease_animal_map(disease_rid, animal_rid)"
                . " VALUES";

        for ($i = 0; $i < count($diseaseRids); $i++) {

            if ($i > 0) {
                $sql .= ", ";
            }

            $sql .= "($diseaseRids[$i], $animalRid)";
        }

        return DB::insertAndGetId($sql);
    }

    public static function alreadyMapped($animalRid) {
        $sql = "SELECT 1 FROM disease_animal_map"
                . " WHERE animal_rid = $animalRid";
        $res = DB::selectOne($sql);
        return !empty($res);
    }

    public static function deleteMapping($animalRid) {
        $sql = "DELETE FROM disease_animal_map"
                . " WHERE animal_rid = $animalRid";
        DB::update($sql);
    }

    public static function getAnimalDiseaseMapping($animalRid) {
        $sql = "SELECT * FROM disease_animal_map AS dam"
                . " JOIN disease AS d ON (dam.disease_rid = d.disease_rid)"
                . " WHERE dam.animal_rid = $animalRid";
        return DB::selectAll($sql);
    }

    public static function isDuplicateDiseaseName($diseaseName) {
        $sql = "SELECT 1 FROM disease WHERE `name` = '$diseaseName'";
        $res = DB::selectOne($sql);
        return !empty($res);
    }

}
