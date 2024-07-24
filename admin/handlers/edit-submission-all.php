<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/submission.php";

if (isset($_POST["submission_date"]) && isset($_POST["submission_time"]) && isset($_POST["submission_title"]) && isset($_POST["old_submission_date"]) && isset($_POST["old_submission_time"]) && isset($_POST["old_submission_title"])) {

    $submission_title = $_POST["submission_title"];
    $date = $_POST["submission_date"];
    $inputTime = $_POST["submission_time"];


    $old_submission_title = $_POST["old_submission_title"];
    $old_date = $_POST["old_submission_date"];
    $old_inputTime = $_POST["old_submission_time"];


    $dateTimeObject = DateTime::createFromFormat('H:i', $inputTime);

    $formattedTime = $dateTimeObject->format('h:i A');

    $time = $formattedTime;

    session_start();
    $db = new Db();
    $submission = new Submission($db->getConnection(), null, null, $submission_title, $date, $time);
    $submission->updateAllSubmissions($old_submission_title, $old_date, $old_inputTime);
    header("LOCATION: ../create-submission-form-all");
}
