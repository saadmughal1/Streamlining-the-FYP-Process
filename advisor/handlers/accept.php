<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/notifications.php";
include_once __DIR__ . "/../classes/admin_notifications.php";
include_once __DIR__ . "/../classes/advisor_group.php";

if (isset($_GET["gid"])) {
    $gid = $_GET["gid"];
    $db = new Db();

    session_start();
    $advisor_group =  new Advisor_group($db->getConnection(), null, $_SESSION["advisor_id"], $gid);
    $advisor_group->acceptGroup();
    $msg = "I approved your project. Now, we await final approval from the admin.";
    $notification = new Notifications($db->getConnection(),null, $msg, $_SESSION["advisor_id"], $gid, 1, 0);
    $notification->sendNotification();
    $msg = "Kindly review and approve the submitted project by the students group. Thank you.";
    $admin_notification = new Admin_notifications($db->getConnection(), null, $msg, $_SESSION["advisor_id"], null, 0, 0,$gid);
    $admin_notification->sendNotification();
    header("LOCATION: ../my-groups");
}
