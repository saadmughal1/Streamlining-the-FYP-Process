<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/meeting.php";
include_once __DIR__ . "/../classes/student_group.php";
include_once __DIR__ . "/../classes/advisor_group.php";

if (isset($_POST["reason"]) && isset($_POST["date"]) && isset($_POST["time"])) {
    $reason = $_POST["reason"];
    $date = $_POST["date"];


    $inputTime = $_POST["time"];

    $dateTimeObject = DateTime::createFromFormat('H:i', $inputTime);

    $formattedTime = $dateTimeObject->format('h:i A');

    $time = $formattedTime;

    session_start();
    $db = new Db();
    $student_group = new Student_group($db->getConnection());
    $res = $student_group->getStudentGroupByRegNo($_SESSION["student_roll_no"])->fetch_assoc()["id"];
    $gid = $res;

    $advisor_group = new Advisor_group($db->getConnection(), null, null, $gid);
    $aid = $advisor_group->getAdvisorByGroupId()->fetch_assoc()["aid"];
    $meeting = new Meeting($db->getConnection(), null, $gid, $aid, $reason, $date, $time, 0);
    $meeting->scheduleMeeting();
    header("LOCATION: ../");
}
