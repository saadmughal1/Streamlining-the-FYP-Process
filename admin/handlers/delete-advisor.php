<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/advisor.php";

if (isset($_GET["aid"])) {

    $aid = $_GET["aid"];

    $db = new Db();

    $advisor = new Advisor($db->getConnection(), $aid);

    $res = $advisor->deleteAdvisor();

    $advisor->updateAdvisor();
    header("LOCATION: ../display-advisors");
}
