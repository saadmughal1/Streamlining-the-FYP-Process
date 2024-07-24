<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
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
                    ADMIN
                </h2>
            </div>
            <ul>
                <li class="mm-active"></li>
                <li><a class="active" href="display-advisors">Display Advisors</a></li>
                <li><a class="active" href="display-advisors-projects">Display All Projects</a></li>
                <li><a class="active" href="create-submission">Create Submission</a></li>
                <li><a class="active" href="add-department">Add Department</a></li>
                <li><a class="active" href="display-students">Display Students</a></li>
        </li>

    </ul>
    </li>
</nav>