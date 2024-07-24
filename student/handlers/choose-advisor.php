<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/student_group.php";
include_once __DIR__ . "/../classes/notifications.php";
session_start();

if (isset($_POST["selectedAdvisor"])) {
    $selectedAdvisor = $_POST["selectedAdvisor"];

    $db = new Db();
    $student_group = new Student_group($db->getConnection());
    $group = $student_group->getStudentGroupByRegNo($_SESSION["student_roll_no"])->fetch_assoc();

    $msg = $group["ptitle"] . ": Group wants to appoint you as an advisor.";
    $notification = new Notifications($db->getConnection(), null, $msg, $selectedAdvisor, $group["id"], 0,0);

    $notification->sendNotification();
    header("LOCATION: ../");
}
