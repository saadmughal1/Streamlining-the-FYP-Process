<div class="container-fluid g-0">
    <div class="row">
        <div class="col-lg-12 p-0">
            <div class="header_iner d-flex justify-content-between align-items-center">
                <div class="sidebar_icon d-lg-none">
                    <i class="ti-menu"></i>
                </div>
                <div class="serach_field-area">
                    <div class="search_inner">
                    </div>
                </div>
                <div class="header_right d-flex justify-content-between align-items-center">
                    <div class="header_notification_warp d-flex align-items-center">
                        <div class="profile_info my-notification me-3 d-block">
                            <?php
                            include_once "classes/db.php";
                            include_once "classes/notifications.php";

                            $db = new Db();
                            $student_group = new Student_group($db->getConnection());
                            $gres = $student_group->getStudentGroupByRegNo($_SESSION["student_roll_no"]);
                            if ($gres->num_rows > 0) {
                                $notification = new Notifications($db->getConnection(), null, null, null, $gres->fetch_assoc()["id"]);
                                $res = $notification->displayNotification();
                            }
                            ?>

                            <a href="#" class="notification-link">
                                <i class="bi bi-bell-fill"></i>
                                <span class="notification-badge"> <?php echo ($res->num_rows > 0) ?  $res->num_rows : 0; ?> </span>
                            </a>

                            <div class="profile_info_iner notification-box">
                                <p>Notifications</p>
                                <?php
                                if ($res->num_rows > 0) {
                                    for ($i = 0; $i < 2; $i++) {
                                        $row = $res->fetch_assoc();
                                        if (!empty($row)) {
                                            echo '<div class="profile_info_details text-start"><a href="handlers/read-notification.php?nid=' . $row["id"] . '"><b>' . $row["username"] . '</b>: <br> ' . $row["msg"] . ' <br><br> ' . $row["date"] . '</a></div>';
                                        }
                                    }
                                    echo '<div class="profile_info_details text-start"><p><a href="view-all-notifications" class="see-all">See all</a></p></div>';
                                } else {
                                    echo '<div class="profile_info_details text-start">No Notifications Available</div>';
                                }
                                ?>
                            </div>

                            
                        </div>
                        <div class="profile_info">
                            <img src="../assets/images/client_img.jpg" alt="#">
                            <div class="profile_info_iner notification-box">
                                <p>Student</p>
                                <h5 class="text-dark"><?php echo $_SESSION["student_username"]; ?></h5>
                                <div class="profile_info_details">
                                    <a href="handlers/logout.php">Log Out <i class="ti-shift-left"></i></a>
                                    <a href="change-password">Change Password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>