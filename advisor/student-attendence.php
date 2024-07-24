<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
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
            <a href="./" class="meeting-groups"><i class="bi bi-arrow-left"></i> Go Back</a>
            <div class="white_box_tittle list_header m-0 align-items-center">
                <div class="main-title mb-sm-15">
                    <h3 class="m-0 nowrap">ATTENDENCE</h3>
                </div>
                <div class="box_right d-flex lms_block">
                    <div class="serach_field-area2">
                        <div class="search_inner"></div>
                    </div>
                </div>
            </div>
            <div class="QA_table ">
                <div class="main_content_iner">
                    <?php
                    include_once "classes/db.php";
                    include_once "classes/student_group.php";
                    include_once "classes/student.php";
                    include_once "classes/attendence.php";
                    $db = new Db();
                    $student = new Student($db->getConnection());
                    $student_group = new Student_group($db->getConnection(), $_GET["gid"]);
                    $res = $student_group->getStudentGroupByGid()->fetch_assoc();
                    $regno = array($res["reg1"], $res["reg2"], $res["reg3"], $res["reg4"])
                    ?>

                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">student name</th>
                                <th scope="col">roll no</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            foreach ($regno as $key => $value) {
                                if (!empty($value)) {
                                    $stdRes = $student->getStudentByRollNo($value)->fetch_assoc();
                            ?>
                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $stdRes["username"] ?></td>
                                        <td><?php echo $value ?></td>

                                        <td>
                                            <div class="">
                                                <?php
                                                $attendence = new Attendence($db->getConnection());
                                                $sres = $student->getStudentByRollNo($value)->fetch_assoc();
                                                $isattendent = $attendence->isAttendenceAvailableByMidAndGid($_GET["mid"], $sres["id"], $_GET["gid"])->num_rows;
                                                ?>
                                                <a href="handlers/<?php echo ($isattendent) ? "mark-absent.php?mid=" . $_GET["mid"] . "&gid=" . $_GET["gid"] . "&sid=" . $sres["id"] : "mark-present.php?mid=" . $_GET["mid"] . "&gid=" . $_GET["gid"] . "&sid=" . $sres["id"]; ?>" class="but <?php if ($isattendent == 0) echo "bg-danger"; ?>"><?php echo ($isattendent > 0) ? "Present" : "Absent" ?></a>
                                            </div>
                                        </td>

                                    </tr>
                            <?php }
                            } ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td> <a href="handlers/done-meeting.php?mid=<?php echo $_GET["mid"]; ?>" class="but">Save</a></td>
                            </tr>


                        </tbody>
                    </table>
                </div>
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