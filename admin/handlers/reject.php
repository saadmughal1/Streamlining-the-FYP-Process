<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/admin_notifications.php";
include_once __DIR__ . "/../classes/advisor.php";
include_once __DIR__ . "/../classes/notifications.php";


if (isset($_POST["feedback"]) && isset($_POST["gid"]) && isset($_POST["nid"]) && isset($_POST["aid"]) && isset($_POST["ptitle"])) {
    $feedback = $_POST["feedback"];
    $ptitle = $_POST["ptitle"];
    $gid = $_POST["gid"];
    $nid = $_POST["nid"];
    $aid = $_POST["aid"];
    $db = new Db();

    session_start();
    $admin_notification = new Admin_notifications($db->getConnection(), $nid, "Rejected: " . $ptitle . "\n " . $feedback, $aid, $_SESSION["advisor_id"], 1, 0, $gid);
    $admin_notification->readNotification();
    $admin_notification->sendNotification();

    $advisor = new Advisor($db->getConnection());
    $advisor->deleteAdvisorProject($aid, $gid);


    $msg = "Project Rejected By Admin: " . $feedback;
    $notification = new Notifications($db->getConnection(), null, $msg, $aid, $gid, 1, 0);
    $notification->sendNotification();


    header("LOCATION: ../");
}
