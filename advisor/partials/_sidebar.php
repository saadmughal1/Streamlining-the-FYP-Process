<?php
session_start();
if (!isset($_SESSION["advisor_id"])) {
    header("Location: ./login");
    exit();
}
?>

<nav class="sidebar">
    <div class="logo d-flex justify-content-between">
        <a href="./">
            <img src="../assets/images/logo.png" alt="" style="width: 250px; height: 45px;padding-right: 100px;">
        </a>
    </div>
    <ul id="sidebar_menu">
        <li class="side_menu_title">
            <div>
                <a class="active" href="./" style="color: lightblue; font-size: 24px; text-decoration: none; font-weight: bold; padding-left: 15px; ">
                    <img src="../assets/images/menu-icon/1.svg" style="margin: 7px;">dashboard
                </a>
            </div>
        </li>
        <li>
            <div>
                <h2 style="color: lightblue; font-size: 24px; text-decoration: none; font-weight: bold; padding-left: 40px;">
                    Advisor
                </h2>
            </div>
            <ul>
                <li><a class="active" href="my-groups">My Groups </a></li>
                <li><a class="active" href="meeting-groups">Schedule Meeting </a></li>
                <li class="mm-active">
                </li>
            </ul>
        </li>
</nav>