<?php
session_start();
unset($_SESSION["advisor_id"]);
unset($_SESSION["advisor_username"]);
header("LOCATION: ../");
?>