<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/admin.php";

if (isset($_GET["gid"]) && isset($_GET["aid"])) {
    $gid = $_GET["gid"];
    $aid = $_GET["aid"];

    $db = new Db();
    $admin = new Admin($db->getConnection());
    $admin->withdraw($gid, $aid);

    header("LOCATION: ../");
}
