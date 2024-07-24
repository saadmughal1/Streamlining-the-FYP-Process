<?php
include_once "classes/db.php";
include_once "classes/advisor.php";
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
                    <h3 class="m-0 nowrap">ADVISORS PROJECTS</h3>
                </div>
            </div>
            <div class="QA_table overflow-auto">
                <!-- Table starts -->
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Advisor Name</th>
                            <th scope="col">Total Groups</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <?php
                    $advisor = new Advisor($db->getConnection());
                    $res = $advisor->getProjectCountOfAllAdvisors();
                    if ($res->num_rows > 0) {
                        $index = 0;
                        while ($row = $res->fetch_assoc()) {
                    ?>
                            <tr>
                                <th><?php echo ++$index; ?></th>
                                <td><?php echo $row["username"]; ?></td>
                                <td><?php echo $row["count_projects"]; ?></td>
                                <th scope="col"><a href="advisor-projects-detail?aid=<?php echo $row["id"]; ?>" class="but">View Details</a></th>
                            </tr>
                    <?php }
                    } else {
                        echo "<td colspan='4' class='text-center'><b><h2>No Advisors Project Available</h2></b></td>";
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