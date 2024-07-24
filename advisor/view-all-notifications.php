<?php

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
        <div class="main_content_iner ">

            <div class="white_box QA_section card_height_100">
                <div class="white_box_tittle list_header m-0 align-items-center mb-5">
                    <div class="main-title mb-sm-15">
                        <h3 class="m-0 nowrap">View All Notifications</h3>
                    </div>
                    <div class="status_bar">
                        <div class="status_circle not_approved"></div>
                        <div class="status_circle improvement"></div>
                        <div class="status_circle approved"></div>
                    </div>
                </div>


                <?php
                include_once "classes/db.php";
                include_once "classes/notifications.php";
                include_once "classes/admin_notifications.php";

                $db = new Db();
                $notification = new Notifications($db->getConnection(), null, null, $_SESSION["advisor_id"]);
                $admin_notification = new Admin_notifications($db->getConnection(), null, null, $_SESSION["advisor_id"]);
                $res = $notification->displayNotification();
                $res1 = $admin_notification->displayNotification();

                if ($res->num_rows > 0 || $res1->num_rows > 0) {
                ?>

                    <?php

                    if ($res->num_rows > 0) {
                        while ($row = $res->fetch_assoc()) {
                    ?>
                            <div class="notif">
                                <div class="text-end">
                                    <a href="handlers/read-notification.php?notif=&gid=<?php echo $row["gid"] . '&nid=' . $row["id"]; ?>">Mark as read</a>
                                </div>
                                <p class="text-dark"><?php echo $row["msg"]; ?></p>
                                <div>
                                    <span><b><?php echo $row["date"]; ?></b></span>
                                </div>
                            </div>

                        <?php
                        }
                    }
                    if ($res1->num_rows > 0) {
                        while ($row = $res1->fetch_assoc()) {

                        ?>
                            <div class="notif">
                                <div class="text-end">
                                    <a href="handlers/read-admin-notification?notif=&nid=<?php echo $row["id"]; ?>">Mark as read</a>
                                </div>
                                <p class="text-dark"><?php echo $row["msg"]; ?></p>
                                <div>
                                    <span><b><?php echo $row["date"]; ?></b></span>
                                </div>
                            </div>
                <?php
                        }
                    }
                } else {
                    echo '<div class="profile_info_details text-start">No Notifications Available</div>';
                }
                ?>




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