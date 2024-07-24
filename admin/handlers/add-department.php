<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/department.php";

if (isset($_POST["dept"])) {
    $dept = $_POST["dept"];

    $db = new Db();

    $department = new Department($db->getConnection(), NULL, $dept);

    $department->addDept();
    header("LOCATION: ../add-department");
}
