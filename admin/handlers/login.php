<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/admin.php";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($_POST["username"]) || empty($_POST["password"])) {
        header("LOCATION: ../login?err=All fields are required");
        die();
    }

    $db = new Db();

    $username = mysqli_real_escape_string($db->getConnection(), $username);
    $password = mysqli_real_escape_string($db->getConnection(), $password);

    $admin = new Admin($db->getConnection(), null, $username, $password);

    $res = $admin->login();

    if ($res->num_rows > 0) {
        session_start();
        $_SESSION["admin_id"] = $res->fetch_assoc()["id"];
        $_SESSION["admin_username"] = $_POST["username"];
        header("LOCATION: ../");
    } else {
        header("LOCATION: ../login?err=Invalid Username or Password.");
        die();
    }
}
