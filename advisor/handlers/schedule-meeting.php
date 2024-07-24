<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/meeting.php";
include_once __DIR__ . "/../classes/student_group.php";
include_once __DIR__ . "/../classes/advisor_group.php";

if (isset($_POST["reason"]) && isset($_POST["date"]) && isset($_POST["time"]) && isset($_POST["gid"])) {
    $reason = $_POST["reason"];
    $date = $_POST["date"];
    $gid = $_POST["gid"];

    $inputTime = $_POST["time"];
    $dateTimeObject = DateTime::createFromFormat('H:i', $inputTime);
    $formattedTime = $dateTimeObject->format('h:i A');
    $time = $formattedTime;


    session_start();
    $db = new Db();
    $student_group = new Student_group($db->getConnection());


    $meeting = new Meeting($db->getConnection(), null, $gid, $_SESSION["advisor_id"], $reason, $date, $time, 1);
    $meeting->scheduleMeeting();
    header("LOCATION: ../");
}
