<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>PROJECT-FLOW</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
                    <h3 class="m-0 nowrap">SUBMISSIONS</h3>
                </div>
                <div class="box_right d-flex lms_block">
                    <div class="serach_field-area2">
                        <div class="search_inner">
                        </div>
                    </div>
                </div>
            </div>
            <div class="QA_table overflow-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Doc</th>
                            <th scope="col">Marks</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        include_once "classes/db.php";
                        include_once "classes/submission.php";
                        $db = new Db();
                        $submission = new Submission($db->getConnection());
                        $res = $submission->getSubmissionByGid($_GET["gid"]);

                        if ($res->num_rows > 0) {
                            $index = 0;
                            while ($row = $res->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo ++$index; ?></td>
                                    <td>
                                        <?php echo $row["title"] ?>
                                    </td>
                                    <td>
                                        <a href="../assets/documents/<?php echo $row["file"]; ?>" class="but btn mb-1" target="_blank">View</a>
                                    </td>

                                    <td>
                                        <?php
                                        if ($row["points"] >= 0) {
                                            echo $row["points"]."/5";
                                        } else {
                                            echo '<a href="mark-numbers?id=' . $row["id"] . '&gid=' . $_GET["gid"] . '">Give Numbers</a>';
                                        }

                                        ?>
                                    </td>

                                </tr>
                        <?php

                            }
                        } else {
                            echo "<td colspan='8' class='text-center'><b><h2>No Groups Available</h2></b></td>";
                        }
                        ?>
                    </tbody>
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

</body>

</html>