<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/agenda.php";


if (isset($_POST["mid"]) && isset($_POST["gid"]) && isset($_POST["agenda"])) {
    $mid = $_POST["mid"];
    $gid = $_POST["gid"];
    $agenda = $_POST["agenda"];


    session_start();
    $db = new Db();
    $agenda = new Agenda($db->getConnection(), null, $mid, $gid, $_SESSION["student_id"], $agenda);
    $agenda->addAgenda();

    header("LOCATION: ../meeting-details?mid=$mid&gid=$gid");
}
