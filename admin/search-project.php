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
                    <h3 class="m-0 nowrap"></h3>
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
                            <th scope="col">Description</th>
                            <th scope="col">Member</th>
                            <th scope="col">doc</th>
                            <th scope="col">Meetings</th>
                            <th scope="col">Create Submission</th>
                        </tr>
                    </thead>

                    <?php
                    $student_group = new Student_group($db->getConnection());
                    $res = $student_group->search($_GET["q"]);
                    if ($res->num_rows > 0) {
                        $index = 0;
                        while ($row = $res->fetch_assoc()) {

                    ?>
                            <tr>
                                <th><?php echo ++$index; ?></th>
                                <td><?php echo $row["group_id"]; ?></td>
                                <td><?php echo $row["ptitle"]; ?></td>
                                <td>
                                    <button type="button" class="btn but p-0 view-btn" data-toggle="modal" data-target="#descriptionModal" data-description="<?php echo $row["idea"]; ?>">
                                        View
                                    </button>
                                </td>
                                <td>
                                    <ul class="list-group">
                                        <li class="list-group-item"><?php echo $row["reg1"] ?></li>
                                        <li class="list-group-item"><?php echo $row["reg2"] ?></li>
                                        <li class="list-group-item"><?php echo $row["reg3"] ?></li>
                                        <li class="list-group-item"><?php echo $row["reg4"] ?></li>
                                    </ul>
                                </td>

                                <th scope="col">
                                    <a href="../assets/documents/<?php echo $row["filename"]; ?>" class="but" target="_blank">View</a>
                                    <a href="../assets/documents/<?php echo $row["filename"]; ?>" class="but" download>Download</a>
                                </th>
                                <th scope="col">
                                    <a href="ongoing-project-meetings?gid=<?php echo  $row["id"]; ?>&aid=<?php echo  $row["aid"]; ?>" class="but">View Meetings</a>
                                </th>
                                <td scope="col">
                                    <a href="create-submission-form?gid=<?php echo $row["id"] ?>" class="but">Create Submission</a>
                                </td>
                            </tr>
                    <?php }
                    } else {
                        echo "<td colspan='7' class='text-center'><b><h2>No Data Found</h2></b></td>";
                    } ?>

                </table>
            </div>
        </div>

    </section>


    <div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog" aria-labelledby="descriptionModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Project Description</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {
            $('.view-btn').on('click', function() {
                var description = $(this).data('description');
                $('#descriptionModal .modal-body').text(description);
            });
        });
    </script>


    <script src="../assets/js/jquery1-3.4.1.min.js"></script>

    <script src="../assets/js/metisMenu.js"></script>

    <script src="../assets/js/jquery.nice-select.min.js"></script>

    <script src="../assets/js/owl.carousel.min.js"></script>

    <script src="../assets/js/tagsinput.js"></script>

    <script src="../assets/js/summernote-bs4.js"></script>

    <script src="../assets/js/custom.js"></script>
</body>

</html>