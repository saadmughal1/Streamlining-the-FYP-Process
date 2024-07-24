<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/notifications.php";
include_once __DIR__ . "/../classes/admin_notifications.php";
include_once __DIR__ . "/../classes/advisor_group.php";

if (isset($_GET["gid"])) {
    $gid = $_GET["gid"];
    $db = new Db();

    session_start();
    $msg = "Kindly review and approve the submitted project by the students group. Thank you.";
    $admin_notification = new Admin_notifications($db->getConnection(), null, $msg, $_SESSION["advisor_id"], null, 0, 0, $gid);
    $admin_notification->sendNotification();
    header("LOCATION: ../my-groups");
}
