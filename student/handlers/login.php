<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/student.php";

if (isset($_POST["roll_no"]) && isset($_POST["password"])) {
    $roll_no = $_POST["roll_no"];
    $password = $_POST["password"];

    if (empty($_POST["roll_no"]) || empty($_POST["password"])) {
        header("LOCATION: ../login?err=All fields are required");
        die();
    }

    $db = new Db();

    $roll_no = mysqli_real_escape_string($db->getConnection(), $roll_no);
    $password = mysqli_real_escape_string($db->getConnection(), $password);

    $student = new Student($db->getConnection(), null, null, $roll_no, $password);

    $res = $student->login();

    if ($res->num_rows > 0) {
        session_start();
        $res = $res->fetch_assoc();
        $_SESSION["student_id"] = $res["id"];
        $_SESSION["student_roll_no"] = $_POST["roll_no"];
        $_SESSION["student_username"] = $res["username"];
        header("LOCATION: ../");
    } else {
        header("Location: ../login?err=Invalid credentials");
        exit();
    }
}
