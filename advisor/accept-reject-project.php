<?php
include_once "classes/db.php";
include_once "classes/student_group.php";
include_once "classes/student.php";

$db = new Db();

?>

<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
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
                    <h3 class="m-0 nowrap">REQUEST</h3>
                </div>
                <div class="box_right d-flex lms_block">
                    <div class="serach_field-area2">
                        <div class="search_inner">
                        </div>
                    </div>
                </div>
            </div>
            <div class="QA_table overflow-auto">
                <span class="text-danger">In case of rejection, please provide feedback for improvement in the feedback box below.</span>
                <form method="POST" action="handlers/reject.php">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Doc</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $student_group = new Student_group($db->getConnection(), $_GET["gid"]);
                            $res = $student_group->getStudentGroupByGid()->fetch_assoc()
                            ?>
                            <tr>
                                <th style="vertical-align: top"><b><?php echo $res["ptitle"] ?></b></th>

                                <td style="vertical-align: top">
                                    <a href="handlers/accept.php?gid=<?php echo $res['id']; ?>&nid=<?php if (isset($_GET["nid"])) echo $_GET['nid']; ?>" class="but">Approve</a>
                                </td>
                                <td style="vertical-align: top">
                                    <button class="p-0 but bg-danger">Reject</button>
                                </td>

                                <td style="vertical-align: top">
                                    <a href="../assets/documents/<?php echo $res["filename"]; ?>" class="but" target="_blank">View</a>
                                    <a href="../assets/documents/<?php echo $res["filename"]; ?>" class="but" download>Download</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Members</th>
                                <th scope="col">Cgpa</th>
                                <th scope="col">Interest</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $student_group = new Student_group($db->getConnection(), $_GET["gid"]);
                            $res = $student_group->getStudentGroupByGid()->fetch_assoc();
                            $std = new Student($db->getConnection());
                            ?>
                            <tr>
                                <?php $r = $std->getStudentByRollNo($res["reg1"])->fetch_assoc() ?>
                                <td style="vertical-align: top">
                                    <?php echo $res["reg1"] ?>
                                </td>
                                <td style="vertical-align: top">
                                    <?php echo $r["cgpa"]; ?>
                                </td>
                                <td style="vertical-align: top">
                                    <?php echo $r["interest"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <?php $r = $std->getStudentByRollNo($res["reg2"])->fetch_assoc() ?>
                                <td style="vertical-align: top">
                                    <?php echo $res["reg2"] ?>
                                </td>
                                <td style="vertical-align: top">
                                    <?php echo $r["cgpa"]; ?>
                                </td>
                                <td style="vertical-align: top">
                                    <?php echo $r["interest"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <?php $r = $std->getStudentByRollNo($res["reg3"])->fetch_assoc() ?>
                                <td style="vertical-align: top">
                                    <?php echo $res["reg3"] ?>
                                </td>
                                <td style="vertical-align: top">
                                    <?php echo $r["cgpa"]; ?>
                                </td>
                                <td style="vertical-align: top">
                                    <?php echo $r["interest"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <?php $r = $std->getStudentByRollNo($res["reg4"]);

                                if ($r->num_rows > 0) {
                                    $r = $r->fetch_assoc();
                                ?>


                                    <td style="vertical-align: top">
                                        <?php echo $res["reg4"] ?>
                                    </td>
                                    <td style="vertical-align: top">
                                        <?php echo $r["cgpa"]; ?>
                                    </td>
                                    <td style="vertical-align: top">
                                        <?php echo $r["interest"]; ?>
                                    </td>

                                <?php } ?>
                            </tr>
                        </tbody>
                    </table>


                    <div class="main-title mb-sm-15">
                        <h3 class="m-0 nowrap">PROJECT IDEA</h3>
                    </div>
                    <p class="pb-4 pt-1">
                        <?php echo $res["idea"] ?>
                    </p>
                    <div class="form-group formRow">
                        <input type="hidden" name="gid" value="<?php echo $res["id"] ?>">
                        <input type="hidden" name="nid" value="<?php if (isset($_GET["nid"])) echo $_GET["nid"] ?>">
                        <label for="feedback">Feedback box</label>
                        <textarea required name="feedback" class="form-control inputField" id="feedback" placeholder="Why You Reject this project ?" cols="30" rows="10"><?php if (isset($_GET["idea"])) echo $_GET["idea"]; ?></textarea>
                    </div>
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