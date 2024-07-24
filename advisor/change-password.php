<?php
include_once "classes/db.php";
include_once "classes/advisor.php";
include_once "classes/student_group.php";
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
                    <h3 class="m-0 nowrap">Change Password</h3>
                </div>
            </div>

            <div class="centerForm">
                <form class="projectForm" method="POST" action="handlers/change-password.php">

                    <div class="form-group">
                        <input type="text" required name="old_password" class="form-control inputField" id="oldpassword" placeholder="Enter old password">
                    </div>

                    <div class="form-group">
                        <input type="text" required name="new_password" class="form-control inputField" id="newpassword" placeholder="Enter new password">
                    </div>

                    <button type="submit" class="but">Change Password</button>
                    <h6 class="text-danger text-center">
                        <?php if (isset($_GET["err"]))
                            echo $_GET["err"]; ?>
                    </h6>
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