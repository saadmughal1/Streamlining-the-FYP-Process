<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/notifications.php";
include_once __DIR__ . "/../classes/advisor_group.php";

if (isset($_GET["nid"]) && isset($_GET["gid"])) {
    $nid = $_GET["nid"];
    $gid = $_GET["gid"];
    $db = new Db();
    $notification = new Notifications($db->getConnection(), $nid);
    $notification->readNotification();

    $advisor_group = new Advisor_group($db->getConnection(), null, null, $gid);

    $res = $advisor_group->getAdvisorByGroupId();
    if ($res->num_rows > 0) {
        header("LOCATION: ../my-groups");
    } else {
        header("LOCATION: ../accept-reject-project?gid=" . $gid);
    }
}
