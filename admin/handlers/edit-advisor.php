<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/advisor.php";

if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["aid"]) && isset($_POST["domain"])) {

    $aid = $_POST["aid"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $domain = $_POST["domain"];

    if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])) {
        header("LOCATION: ../edit-advisor?aid=" . $aid . "&err=All fields are required");
        die();
    }

    $db = new Db();

    $advisor = new Advisor($db->getConnection(), $aid, $username, $email, $password);

    $res = $advisor->getAdvisorByEmail();

    if ($res->num_rows > 0 && $res->fetch_assoc()["id"] != $aid) {
        header("LOCATION: ../edit-advisor?aid=" . $aid . "&err=Email Already in use");
        die();
    }

    $advisor->updateAdvisor($domain);
    header("LOCATION: ../display-advisors");
}
