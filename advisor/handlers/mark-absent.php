<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/attendence.php";

if (isset($_GET["mid"]) && isset($_GET["gid"]) && isset($_GET["sid"])) {
    $mid = $_GET["mid"];
    $gid = $_GET["gid"];
    $sid = $_GET["sid"];

    $db = new Db();
    $attendence = new Attendence($db->getConnection());

    $attendence->unMarkAttencence($mid, $sid, $gid);
    header("LOCATION: ../student-attendence?mid=$mid&gid=$gid");
}
