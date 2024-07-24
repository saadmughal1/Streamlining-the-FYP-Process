<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/advisor.php";
include_once __DIR__ . "/../classes/admin_notifications.php";

session_start();
if (isset($_POST["old_password"]) && isset($_POST["new_password"])) {
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];

    $db = new Db();
    $advisor = new Advisor($db->getConnection(), $_SESSION["advisor_id"]);

    $res = $advisor->getAdvisorById($_SESSION["advisor_id"])->fetch_assoc();

    if ($res["password"] == $old_password) {
        $advisor->updatePassword($new_password);
        $admin_notification = new Admin_notifications($db->getConnection());
        $admin_notification->readChangePasswordNotif($_SESSION["advisor_id"]);
    } else {
        header("LOCATION: ../change-password?err=Invalid old password");
        exit();
    }
    header("LOCATION: ../");
}
