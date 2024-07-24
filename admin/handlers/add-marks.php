<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/submission.php";

session_start();
if (isset($_POST["marks"]) && isset($_POST["gid"]) && isset($_POST["id"])) {
    $marks = $_POST["marks"];
    $gid = $_POST["gid"];
    $id = $_POST["id"];

    if ($marks < 0 || $marks > 100) {
        header("LOCATION: ../mark-numbers?err=Invalid marks range&id=" . $id . "&gid=" . $gid);
        exit();
    } else {
        $db = new Db();
        $submission = new Submission($db->getConnection());
        $submission->submitMarks($id, $marks);
    }

    header("LOCATION: ../view-submissions?gid=" . $gid);
}
