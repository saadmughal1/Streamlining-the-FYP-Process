<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/submission.php";

if (isset($_POST["gid"]) && isset($_POST["sid"]) && isset($_FILES["file"])) {
    $gid = $_POST["gid"];
    $sid = $_POST["sid"];

    $fileData = $_FILES["file"];


    $extension = pathinfo($fileData['name'], PATHINFO_EXTENSION);

    $milliseconds = round(microtime(true) * 1000);
    $newFileName = $milliseconds . '.' . $extension;



    $uploadPath = '../../assets/documents/' . $newFileName;
    move_uploaded_file($fileData['tmp_name'], $uploadPath);

    $db = new Db();
    $submission =  new Submission($db->getConnection());
    $submission->submitData($gid, $sid, $newFileName);
    header("LOCATION: ../submission");
}
