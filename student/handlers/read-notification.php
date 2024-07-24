<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/notifications.php";

if (isset($_GET["nid"])) {
    $nid = $_GET["nid"];
    $db = new Db();
    $notification = new Notifications($db->getConnection(), $nid);
    $notification->readNotification();

    if (isset($_GET["notif"])) {
        header("LOCATION: ../view-all-notifications");
    } else {
        header("LOCATION: ../");
    }
}
