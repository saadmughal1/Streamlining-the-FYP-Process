<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/advisor.php";
include_once __DIR__ . "/../classes/admin_notifications.php";


if (isset($_POST["dept"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $dept = $_POST["dept"];
    $domain = $_POST["domain"];

    if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])) {
        header("LOCATION: ../add-advisor?err=All fields are required");
        die();
    }

    $db = new Db();

    $advisor = new Advisor($db->getConnection(), null, $username, $email, $password);

    if ($advisor->getAdvisorByEmail()->num_rows > 0) {
        header("LOCATION: ../add-advisor?err=Email Already in use");
        die();
    }

    $res = $advisor->addAdvisor($dept, $domain);


    $advId = $advisor->getAdvisorByUsernameEmailAndPassword()->fetch_assoc()["id"];



    $msg = '<a href="change-password">Click Here to change your password.</a>';
    session_start();
    $admin_notification = new Admin_notifications($db->getConnection(), -1, $msg, $advId, $_SESSION["admin_id"], 1, 0, -1);
    $admin_notification->sendNotification();
    // $admin_notification->readNotification();



    header("LOCATION: ../display-advisors");
}
