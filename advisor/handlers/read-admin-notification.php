<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/admin_notifications.php";

if (isset($_GET["nid"])) {
    $nid = $_GET["nid"];
    $db = new Db();
    $admin_notification = new Admin_notifications($db->getConnection(), $nid);
    $admin_notification->readNotification();
    if (isset($_GET["notif"])) {
        header("LOCATION: ../view-all-notifications");
    } else {
        header("LOCATION: ../");
    }
}
