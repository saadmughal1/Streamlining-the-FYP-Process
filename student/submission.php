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
                    <h3 class="m-0 nowrap">Submissions</h3>
                </div>
            </div>

            <div class="QA_table">
                <div class="main_content_iner">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Action</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include_once "classes/db.php";
                            include_once "classes/submission.php";
                            include_once "classes/student_group.php";
                            $db = new Db();
                            $student_group = new Student_group($db->getConnection());
                            $res = $student_group->getStudentGroupByRegNo($_SESSION["student_roll_no"]);

                            date_default_timezone_set('Asia/Karachi');
                            $currentTime = date("g:i A");
                            $currentDate = date("Y-m-d");
                            $currentTimestamp = strtotime("$currentDate $currentTime");

                            if ($res->num_rows > 0) {
                                $gid = $res->fetch_assoc()["id"];
                                $submission = new Submission($db->getConnection());
                                $res = $submission->getSubmissions($gid);


                                if ($res->num_rows > 0) {
                                    $index = 0;
                                    
                                    while ($row = $res->fetch_assoc()) {

                                        $givenDate = $row["date"];
                                        $givenTime = $row["time"];
                                        $givenTimestamp = strtotime("$givenDate $givenTime");
                                        if ($currentTimestamp < $givenTimestamp) {
                                            $subRes = $submission->isAlreadySubmitted($gid, $row["id"]);
                            ?>

                                            <form action="handlers/submission.php" method="POST" enctype="multipart/form-data">
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="gid" value="<?php echo $row["gid"] ?>">
                                                        <input type="hidden" name="sid" value="<?php echo $row["id"] ?>">
                                                        <?php echo ++$index ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["title"] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["date"] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["time"] ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <?php echo ($subRes->num_rows == 0) ? '<input required type="file" name="file" class="form-control inputField" id="file-doc">' : 'File Submitted.'; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php if ($subRes->num_rows == 0) echo '<button class="but h-100">submit</button>'; ?>
                                                    </td>
                                                </tr>
                                            </form>
                            <?php
                                        }
                                    }
                                }
                            } else {
                            } ?>
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