<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/meeting.php";

if (isset($_GET["mid"])) {
    $mid = $_GET["mid"];
    $db = new Db();
    $meeting = new Meeting($db->getConnection(),$mid);
    $meeting->doneMeeting();
    header("LOCATION: ../");
}
