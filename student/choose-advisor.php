<?php
include_once "classes/db.php";
include_once "classes/advisor.php";
include_once "classes/student.php";
$db = new Db();
?>


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
                    <h3 class="m-0 nowrap">Choose Advisor</h3>
                </div>
            </div>

            <div class="form-container">
                <div class="form-header">
                    <span class="form-title">FORM</span>
                </div>
                <div class="form-body">
                    <!-- Your form elements go here -->
                </div>
            </div>
            <br>

            <div class="centerForm">
                <form class="projectForm" method="POST" action="handlers/choose-advisor.php">

                    <div class="student_entry formRow">

                        <div class="form-group">
                            <label for="groups">Advisor:</label>
                            <select id="group" class="inputField" name="selectedAdvisor" required>
                                <?php
                                $advisor = new Advisor($db->getConnection());
                                $student = new Student($db->getConnection());
                                session_start();
                                $std_dept = $student->getStudentByRollNo($_SESSION["student_roll_no"])->fetch_assoc()["dept"];




                                $res = $advisor->getAdvisorTotalSlots();
                                if ($res->num_rows > 0) {
                                    echo '<option disabled selected value="">Choose Advisor</option>';
                                    while ($row = $res->fetch_assoc()) {
                                        if ($row["project_count"] < 5 && $row["dept"] == $std_dept) {
                                            echo '<option value="' . $row["id"] . '">' . $row["username"] . " - " . $row["domain"] . '</option>';
                                        }
                                    }
                                } else {
                                    echo '<option disabled selected value="">No Advisors Available</option>';
                                }
                                ?>
                            </select>

                        </div>
                        <br>
                        <button type="submit" class="but">Submit</button>
                </form>
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