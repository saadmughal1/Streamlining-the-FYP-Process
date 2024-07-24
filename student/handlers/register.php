<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/student.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $roll_no = $_POST["roll_no"];
    $password = $_POST["password"];
    $dept = $_POST["department"];
    $cgpa = $_POST["cgpa"];
    $interest = $_POST["interest"];
    $credit_hours = $_POST["credit_hours"];

    $db = new Db();
    $student = new Student($db->getConnection(), null, $username, $roll_no, $password);

    if ($student->getStudentByRollNo($roll_no)->num_rows > 0) {
        echo "Registration No Already in use";
        exit();
    }

    $student->register($dept, $cgpa, $interest, $credit_hours);
    echo "success";
} else {
    echo "Invalid request method";
}
