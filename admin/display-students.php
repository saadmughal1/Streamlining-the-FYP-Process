<?php
include_once "classes/db.php";
include_once "classes/student.php";
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
        <div class="white_box QA_section card_height_100">
            <div class="white_box_tittle list_header m-0 align-items-center mb-3">
                <div class="main-title mb-sm-15">
                    <h3 class="m-0 nowrap">STUDENTS LIST</h3>
                </div>

                <a href="add-student" class="but mb-2">Add new Student</a>

            </div>
            <div class="QA_table overflow-auto">
                <!-- Table starts -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Roll No</th>
                            <th scope="col">Password</th>
                            <th scope="col">Department</th>
                            <th scope="col">CGPA</th>
                            <th scope="col">Credit Hours</th>
                            <th scope="col">Interest</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <?php
                    $student = new Student($db->getConnection());
                    $res = $student->display();
                    if ($res->num_rows > 0) {
                        $index = 0;
                        while ($row = $res->fetch_assoc()) {

                    ?>
                            <tr>
                                <th><?php echo ++$index; ?></th>
                                <th><?php echo $row["username"]; ?></th>
                                <th><?php echo $row["roll_no"]; ?></th>
                                <th><?php echo $row["password"]; ?></th>
                                <th><?php echo $row["dept"]; ?></th>
                                <th><?php echo $row["cgpa"]; ?></th>
                                <th><?php echo $row["credit_hours"]; ?></th>
                                <th><?php echo $row["interest"]; ?></th>
                                <td>
                                    <a href="edit-student?sid=<?php echo $row["id"]; ?>" class="but">EDIT</a>
                                </td>
                            </tr>
                    <?php }
                    } else {
                        echo "<td colspan='10' class='text-center'><b><h2>No Students Available</h2></b></td>";
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