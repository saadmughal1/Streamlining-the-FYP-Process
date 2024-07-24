<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/student.php";
session_start();

if (isset($_POST["old_password"]) && isset($_POST["new_password"])) {
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];

    $db = new Db();
    $student = new Student($db->getConnection(), $_SESSION["student_id"]);

    $res = $student->getStudentById()->fetch_assoc();

    if ($res["password"] == $old_password) {
        $student->updatePassword($new_password);
    } else {
        header("LOCATION: ../change-password?err=Invalid old password");
        exit();
    }
    header("LOCATION: ../");
}
