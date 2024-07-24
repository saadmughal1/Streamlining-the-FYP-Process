<?php
include_once "classes/db.php";
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
                    <h3 class="m-0 nowrap">Update Project Info</h3>
                </div>
                <div class="status_bar">
                    <div class="status_circle not_approved"></div>
                    <div class="status_circle improvement"></div>
                    <div class="status_circle approved"></div>
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
                <?php
                $student_group = new Student_group($db->getConnection());
                $res = $student_group->getStudentGroupByRegNo($_SESSION["student_roll_no"])->fetch_assoc();
                ?>

                <form method="POST" action="handlers/update-project-info.php" enctype="multipart/form-data">
                    <input type="hidden" name="gid" value="<?php echo $res["id"] ?>">
                    <div class="form-group">
                        <label for="projectTitle">Project Title</label>
                        <input type="text" required name="ptitle" class="form-control inputField" id="projectTitle" placeholder="Enter Project Title" value="<?php echo $res["ptitle"] ?>">
                    </div>
                    <div class="form-group formRow">
                        <label for="projectIdea">Project Idea</label>
                        <textarea required name="idea" class="form-control inputField" id="projectIdea" placeholder="Enter Project Idea" cols="30" rows="10"><?php echo $res["idea"] ?></textarea>
                    </div>

                    <input type="hidden" name="old_file" value="<?php echo $res["filename"]; ?>">

                    <div class="form-group">
                        <label for="file-doc">Attach New File</label>
                        <a href="../assets/documents/<?php echo $res["filename"]; ?>" target="_blank">View Old File</a>
                        <input type="file" name="file" class="form-control inputField" id="file-doc">
                    </div>

                    <button type="submit" class="but">Update</button>

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