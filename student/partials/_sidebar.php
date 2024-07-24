<?php
session_start();
if (!isset($_SESSION["student_id"])) {
    header("Location: ./login");
    exit();
}


include_once "classes/db.php";
include_once "classes/student_group.php";
include_once "classes/advisor_group.php";
$db = new Db();
$student_group = new Student_group($db->getConnection());
$res = $student_group->getStudentGroupByRegNo($_SESSION["student_roll_no"]);
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
                    Student
                </h2>
            </div>
            <ul>
                <li class="mm-active">

                    <?php
                    if ($res->num_rows == 0) {
                        echo '<li><a class="active" href="make-group">Make Group </a></li>';
                    }
                    ?>

                    <?php
                    if ($res->num_rows > 0) {
                        $gid = $res->fetch_assoc()["id"];
                        $advisor_group = new Advisor_group($db->getConnection(), null, null, $gid);
                        if ($advisor_group->getAdvisorByGroupId()->num_rows == 0) {
                            echo '<li><a class="active" href="choose-advisor">Choose Advisor </a></li>';
                        }
                        if ($advisor_group->getAdvisorByGroupId()->num_rows > 0) {
                            echo '<li><a class="active" href="schedule-meeting">Schedule Meeting </a></li>';
                            echo '<li><a class="active" href="submission">Submissions </a></li>';
                        }
                    }
                    ?>
                    <?php
                    if ($res->num_rows > 0) {
                        if ($advisor_group->isGroupApproved()->num_rows == 0) {
                            echo '<li><a class="active" href="update-project-info">Update Project info </a></li>';
                        }
                    }
                    ?>
                </li>
            </ul>
        </li>
</nav>