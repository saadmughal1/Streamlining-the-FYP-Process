<?php
include_once "classes/db.php";
include_once "classes/student_group.php";
include_once "classes/submission.php";
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
                    <h3 class="m-0 nowrap">ONGOING PROJECTS</h3>
                </div>
                <div class="serach_field-area">
                    <div class="search_inner">
                        <form action="search-project" method="GET">
                            <div class="search_field">
                                <input type="text" name="q" placeholder="Search group id here...">
                            </div>
                            <button type="submit"> <img src="assets/images/icon/icon_search.svg" alt=""> </button>
                        </form>
                    </div>
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
                            <th scope="col">Advisor</th>
                            <th scope="col">Grade</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <?php
                    $student_group = new Student_group($db->getConnection());
                    $submission = new Submission($db->getConnection());
                    $res = $student_group->onGoingProjects();
                    if ($res->num_rows > 0) {
                        $index = 0;


                        while ($row = $res->fetch_assoc()) {

                            $marks = $submission->displaySubmissionsByGid($row["gid"]);

                            $admin_marks = 0;
                            $advisor_marks = 0;
                            $count = 0;

                            while ($m = $marks->fetch_assoc()) {
                                $admin_marks += $m["admin_points"] / 100;
                                $advisor_marks += $m["points"] / 5;
                                $count++;
                            }
                    ?>
                            <tr>
                                <th><?php echo ++$index; ?></th>
                                <td><?php echo $row["group_id"]; ?></td>
                                <td><?php echo $row["ptitle"]; ?></td>
                                <td><?php echo $row["advisorUsername"]; ?></td>
                                <td><?php echo $submission->calculateGrade(($advisor_marks * 20 * 0.70) + ($admin_marks * 0.3 * 100)); ?></td>
                                <th scope="col"><a href="ongoing-project-meetings?gid=<?php echo $row["gid"]; ?>&aid=<?php echo $row["aid"]; ?>" class="but">View Meetings</a></th>
                                <th scope="col"><a onclick="return confirm('Are you sure you want to withdraw this group?')" href="handlers/withdraw-group.php?gid=<?php echo $row["gid"]; ?>&aid=<?php echo $row["aid"]; ?>" class="but">Withdraw Group</a></th>
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