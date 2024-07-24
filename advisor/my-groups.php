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
                    <h3 class="m-0 nowrap">MY GROUPS </h3>
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
                            <th scope="col">Description</th>
                            <th scope="col">Members</th>
                            <th scope="col">Feedback</th>
                            <th scope="col">Meetings</th>
                            <th scope="col">Doc</th>
                            <th scope="col">Submissions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        include_once "classes/db.php";
                        include_once "classes/advisor.php";
                        $db = new Db();
                        $advisor = new Advisor($db->getConnection(), $_SESSION["advisor_id"]);
                        $res = $advisor->getGroupsById();

                        if ($res->num_rows > 0) {
                            $index = 0;
                            while ($row = $res->fetch_assoc()) {

                        ?>
                                <tr>
                                    <td><?php echo ++$index; ?></td>
                                    <td>
                                        <?php echo $row["ptitle"] ?>
                                    </td>
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

                                    <td>
                                        <form action="handlers/send-feedback.php" method="POST">
                                            <input type="hidden" name="gid" value="<?php echo $row["id"] ?>">
                                            <div class="form-group formRow">
                                                <textarea required name="feedback" class="form-control inputField" id="projectIdea" placeholder="Add Feedback" cols="10" rows="4"></textarea>
                                            </div>
                                            <button type="submit" class="but p-0 float-end">Send</button>
                                        </form>
                                    </td>

                                    <td>
                                        <a href="ongoing-project-meetings?gid=<?php echo $row["id"]; ?>&aid=<?php echo $_SESSION["advisor_id"] ?>" class="but btn">View Meetings</a>
                                    </td>

                                    <td>
                                        <a href="../assets/documents/<?php echo $row["filename"]; ?>" class="but btn mb-1" target="_blank">View</a>
                                        <a href="../assets/documents/<?php echo $row["filename"]; ?>" class="but btn" download>Download</a>
                                    </td>

                                    <td>
                                        <a href="view-submissions?gid=<?php echo $row["id"]; ?>" class="but btn">View</a>
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


    <script>
        $(document).ready(function() {
            $('.view-btn').on('click', function() {
                var description = $(this).data('description');
                $('#descriptionModal .modal-body').text(description);
            });
        });
    </script>
</body>

</html>