<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/submission.php";
include_once __DIR__ . "/../classes/student_group.php";

if (isset($_POST["submission_date"]) && isset($_POST["submission_time"]) && isset($_POST["submission_title"])) {

    $submission_title = $_POST["submission_title"];

    $date = $_POST["submission_date"];
    $inputTime = $_POST["submission_time"];

    $dateTimeObject = DateTime::createFromFormat('H:i', $inputTime);

    $formattedTime = $dateTimeObject->format('h:i A');

    $time = $formattedTime;

    session_start();
    $db = new Db();
    $submission = new Submission($db->getConnection(), null, null, $submission_title, $date, $time);

    $student_group = new Student_group($db->getConnection());

    $res = $student_group->getAllGroups();

    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $submission->createSubmissionByGidInFunction($row["id"]);
        }
    }

    header("LOCATION: ../create-submission-form-all");
}
