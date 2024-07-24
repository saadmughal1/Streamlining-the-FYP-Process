<?php
include_once "classes/db.php";
include_once "classes/student_group.php";
$db = new Db();
?>

<!DOCTYPE html>
<html lang="en">

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
        <!-- Main content goes here -->
        <div class="white_box QA_section card_height_100">
            <div class="white_box_tittle list_header m-0 align-items-center mb-3">
                <div class="main-title mb-sm-15">
                    <h3 class="m-0 nowrap">Create Submission</h3>
                </div>

                <div>
                    <a href="create-submission-form-all" class="but mb-2">Create Submission for all</a>
                    <a href="view-submissions-all" class="but mb-2">View Submissions</a>
                </div>

            </div>
            <div class="QA_table overflow-auto">
                <!-- Table starts -->
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">GroupId</th>
                            <th scope="col">Project Title</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <?php
                    $student_group = new Student_group($db->getConnection());
                    $res = $student_group->displayGroup();
                    if ($res->num_rows > 0) {
                        $index = 0;
                        while ($row = $res->fetch_assoc()) {
                    ?>
                            <tr>
                                <th><?php echo ++$index; ?></th>
                                <td><?php echo $row["group_id"]; ?></td>
                                <td><?php echo $row["ptitle"]; ?></td>
                                <td>
                                    <a href="create-submission-form?gid=<?php echo $row["id"] ?>" class="but">Create Submission</a>
                                    <a href="view-submissions?gid=<?php echo $row["id"] ?>" class="but">View Submissions</a>
                                </td>
                            </tr>
                    <?php }
                    } else {
                        echo "<td colspan='4' class='text-center'><b><h2>No Project Available</h2></b></td>";
                    } ?>

                </table>
                <!-- Table ends -->
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