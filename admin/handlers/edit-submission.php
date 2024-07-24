<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/submission.php";

if (isset($_POST["gid"]) && isset($_POST["sid"]) && isset($_POST["submission_date"]) && isset($_POST["submission_time"]) && isset($_POST["submission_title"])) {
    $sid = $_POST["sid"];
    $gid = $_POST["gid"];

    $submission_title = $_POST["submission_title"];
    $date = $_POST["submission_date"];
    $inputTime = $_POST["submission_time"];

    $dateTimeObject = DateTime::createFromFormat('H:i', $inputTime);

    $formattedTime = $dateTimeObject->format('h:i A');

    $time = $formattedTime;

    session_start();
    $db = new Db();
    $submission = new Submission($db->getConnection(), $sid, null, $submission_title, $date, $time);
    $submission->updateSubmission();
    header("LOCATION: ../create-submission-form?gid=$gid");
}
