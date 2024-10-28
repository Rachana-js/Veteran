<?php

function uploadFile($fieldName) {

    $fielUploadPath = '../uploads/';

    $uploadedFileType = strtolower(pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION));  // .txt

    $fileName = uniqid(rand()); // hghghg3434gfgfd6757

    $fileName = $fileName . "." . $uploadedFileType;    // hghghg3434gfgfd6757.txt

    $fullUploadPath = $fielUploadPath . $fileName;    // uploads/hghghg3434gfgfd6757.txt

    $acceptedFileTypes = array('jpg', 'jpeg', 'png');

    if (in_array($uploadedFileType, $acceptedFileTypes)) {
        if (is_uploaded_file($_FILES[$fieldName]['tmp_name']) &&
                move_uploaded_file($_FILES[$fieldName]['tmp_name'], $fullUploadPath)) {
            return $fileName;
        } else {
            throw new Exception("An error occurred while uploading file. Please try again");
        }
    } else {
        throw new Exception("Please upload valid JPG or PNG image");
    }
}

function trimText($str, $noOfChars) {
    if (strlen($str) <= $noOfChars) {
        return $str;
    }

    return substr($str, 0, $noOfChars) . "...";
}
