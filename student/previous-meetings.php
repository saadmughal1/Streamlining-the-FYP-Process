<!DOCTYPE html>
<html lang="">

<head>

    <title>PROJECT-FLOW</title>

    <link rel="stylesheet" href="../assets/css/bootstrap1.min.css" />

    <link rel="stylesheet" href="../assets/css/themify-icons.css" />

    <link rel="stylesheet" href="../assets/css/metisMenu.css">

    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="crm_body_bg">
    <?php include_once "partials/_sidebar.php"; ?>
    <section class="main_content dashboard_part">
        <?php include_once "partials/_navbar.php"; ?>
        <div class="white_box QA_section card_height_100">
            <div class="white_box_tittle list_header m-0 align-items-center mb-3">
                <div class="main-title mb-sm-15">
                    <h3 class="m-0 nowrap">Previous Meetings</h3>
                </div>
            </div>

            <div class="QA_table overflow-auto">


                <?php

                include_once "classes/db.php";
                include_once "classes/student_group.php";
                include_once "classes/meeting.php";

                $db = new Db();
                $student_group = new Student_group($db->getConnection());

                $stdGroup = $student_group->getStudentGroupByRegNo($_SESSION["student_roll_no"]);

                if ($stdGroup->num_rows > 0) {
                    $stdGid = $stdGroup->fetch_assoc()["id"];
                    $meeting = new Meeting($db->getConnection(), null, $stdGid);
                    $res = $meeting->previousMeetings();

                ?>

                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Meeting Title</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            if ($res->num_rows > 0) {
                                $index = 0;
                                while ($row = $res->fetch_assoc()) {


                            ?>
                                    <tr>
                                        <td><?php echo ++$index; ?></td>
                                        <td><?php echo $row["reason"]; ?></td>
                                        <td><?php echo $row["date"]; ?></td>
                                        <td><?php echo $row["time"]; ?></td>
                                        <td>
                                            <a href="meeting-details?mid=<?php echo $row["id"]; ?>&gid=<?php echo $row["gid"]; ?>" class="but">Meeting Details</a>
                                        </td>
                                    </tr>
                        <?php
                                }
                            } else {
                                echo "<td colspan='5' class='text-center'><b><h2>No Meetings Scheduled</h2></b></td>";
                            }
                        } else {
                            echo '<a href="make-group" class="active" style="color:#55aede;">Make Group</a>';
                        }
                        ?>
                        </tbody>

                    </table>
            </div>
        </div>
    </section>




    <script src="../assets/js/jquery1-3.4.1.min.js"></script>

    <script src="../assets/js/metisMenu.js"></script>

    <script src="../assets/js/jquery.nice-select.min.js"></script>

    <script src="../assets/js/owl.carousel.min.js"></script>

    <script src="../assets/js/tagsinput.js"></script>

    <script src="../assets/js/summernote-bs4.js"></script>

    <script src="../assets/js/custom.js"></script>
</body>

</html>