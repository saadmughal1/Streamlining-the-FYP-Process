<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/meeting.php";
include_once __DIR__ . "/../classes/notifications.php";

if (isset($_GET["gid"]) && isset($_GET["mid"]) && isset($_GET["reason"])) {
    $mid = $_GET["mid"];
    $gid = $_GET["gid"];
    $reason = $_GET["reason"];

    $db = new Db();
    $meeting = new Meeting($db->getConnection(), $mid);

    session_start();
    $msg = mysqli_escape_string($db->getConnection(), $msg);
    $notification = new Notifications($db->getConnection(), null, $reason, $_SESSION["advisor_id"], $gid, 1, 0);
    $notification->sendNotification();
    $meeting->rejectMeeting();

    header("LOCATION: ../");
}
