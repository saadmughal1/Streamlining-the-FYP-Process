<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/meeting.php";
include_once __DIR__ . "/../classes/notifications.php";

if (isset($_GET["gid"]) && isset($_GET["mid"]) && isset($_GET["date"]) && isset($_GET["time"])) {
    $mid = $_GET["mid"];
    $gid = $_GET["gid"];

    $givenDate = $_GET["date"];
    $givenTime = $_GET["time"];
    // $givenTimestamp = strtotime("$givenDate $givenTime");
    // echo "<br>";

    date_default_timezone_set('Asia/Karachi');
    $currentTime = date("g:i A");
    $currentDate = date("Y-m-d");
    // $currentTimestamp = strtotime("$currentDate $currentTime");
    $db = new Db();
    $meeting = new Meeting($db->getConnection(), $mid);

    $givenTimestamp = strtotime("$givenDate $givenTime");
    $currentTimestamp = strtotime(date("Y-m-d") . " $currentTime");

    session_start();

    if ($currentTimestamp > $givenTimestamp) {
        $msg = "The meeting has been automatically rejected due to late approval. Let's schedule another meeting.";
        $msg = mysqli_escape_string($db->getConnection(), $msg);
        $notification = new Notifications($db->getConnection(), null, $msg, $_SESSION["advisor_id"], $gid, 1, 0);
        $notification->sendNotification();
        $meeting->rejectMeeting();
    } else {
        $msg = "The meeting has been accepted; please arrive on time.";
        $notification = new Notifications($db->getConnection(), null, $msg, $_SESSION["advisor_id"], $gid, 1, 0);
        $notification->sendNotification();
        $meeting->acceptMeeting();
    }
    header("LOCATION: ../");
}
