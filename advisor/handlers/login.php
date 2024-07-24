<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/advisor.php";

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($_POST["email"]) || empty($_POST["password"])) {
        header("LOCATION: ../login?err=All fields are required");
        die();
    }

    $db = new Db();

    $email = mysqli_real_escape_string($db->getConnection(), $email);
    $password = mysqli_real_escape_string($db->getConnection(), $password);

    $advisor = new Advisor($db->getConnection(), null, null, $email, $password);

    $res = $advisor->login();
    if ($res->num_rows > 0) {
        $res = $res->fetch_assoc();
        session_start();
        $_SESSION["advisor_id"] = $res["id"];
        $_SESSION["advisor_username"] = $res["username"];
        header("LOCATION: ../");
    } else {
        header("LOCATION: ../login?err=Invalid email or Password.");
        die();
    }
}
