<?php
 
include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/admin.php";
include_once __DIR__ . "/../classes/notifications.php";
include_once __DIR__ . "/../classes/admin_notifications.php";
include_once __DIR__ . "/../classes/student_group.php";

if (isset($_GET["gid"]) && isset($_GET["nid"]) && isset($_GET["aid"])) {
    $gid = $_GET["gid"];
    $nid = $_GET["nid"];
    $aid = $_GET["aid"];
    $db = new Db();

    $currentMonth = date('m');
    $semester = "";

    if (in_array($currentMonth, range(3, 7))) {
        $semester = 's';
    } elseif (in_array($currentMonth, range(10, 12)) || in_array($currentMonth, range(1, 2))) {
        $semester = 'f';
    }

    $group_id = $semester . date("y") . "bs" . $gid;

    $student_group = new Student_group($db->getConnection());
    $student_group->setGroupId($group_id, $gid);

    session_start();
    $admin = new Admin($db->getConnection());
    $admin->approveProject($gid);

    $msg = "Congratulations! Your project has been approved by the admin. Let's continue working towards success.";
    $msg = mysqli_real_escape_string($db->getConnection(), $msg);
    $notification = new Notifications($db->getConnection(), null, $msg, $aid, $gid, 1, 0);
    $notification->sendNotification();

    $msg =  $_SESSION["admin_username"] . ": \nThe project has been approved. Please proceed with the next steps. Thank you.";
    $msg = mysqli_real_escape_string($db->getConnection(), $msg);

    $admin_notification = new Admin_notifications($db->getConnection(), $nid, $msg, $aid, $_SESSION["admin_id"], 1, 0, $gid);
    $admin_notification->sendNotification();
    $admin_notification->readNotification();

    header("LOCATION: ../");
}
