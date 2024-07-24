<?php
session_start();
unset($_SESSION["student_id"]);
unset($_SESSION["student_roll_no"]);
unset($_SESSION["student_username"]);
header("LOCATION: ../");
?>