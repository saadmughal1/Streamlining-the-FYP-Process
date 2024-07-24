<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/notifications.php";

if (isset($_POST["feedback"]) && isset($_POST["gid"])) {
    $feedback = $_POST["feedback"];
    $gid = $_POST["gid"];
    $db = new Db();

    session_start();
    $notification = new Notifications($db->getConnection(), null,"Announcement: \n".$feedback, $_SESSION["advisor_id"], $gid, 1, 0);
    $notification->sendNotification();
    header("LOCATION: ../my-groups");
}
