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
                            include_once "classes/admin_notifications.php";

                            $db = new Db();
                            $notification = new Notifications($db->getConnection(), null, null, $_SESSION["advisor_id"]);
                            $admin_notification = new Admin_notifications($db->getConnection(), null, null, $_SESSION["advisor_id"]);
                            $res = $notification->displayNotification();
                            $res1 = $admin_notification->displayNotification();
                            ?>
                            <a href="" class="notification-link">
                                <i class="bi bi-bell-fill"></i>
                                <span class="notification-badge"> <?php echo  $res->num_rows + $res1->num_rows; ?> </span>
                            </a>
                            <div class="profile_info_iner notification-box">
                                <p>Notifications</p>
                                <?php
                                if ($res->num_rows > 0 || $res1->num_rows > 0) {
                                    if ($res->num_rows > 0) {
                                        for ($i = 0; $i < 2; $i++) {
                                            $row = $res->fetch_assoc();
                                            if (!empty($row)) {
                                                echo '<div class="profile_info_details text-start text-light"><a href="handlers/read-notification.php?gid=' . $row["gid"] . '&nid=' . $row["id"] . '">' . $row["msg"] . ' <br><br> ' . $row["date"] . '</a></div>';
                                            }
                                        }
                                    }
                                    if ($res1->num_rows > 0) {
                                        for ($i = 0; $i < 2; $i++) {
                                            $row = $res1->fetch_assoc();
                                            if (!empty($row)) {
                                                echo '<div class="profile_info_details text-start"><a href="handlers/read-admin-notification?nid=' . $row["id"] . '">' . $row["msg"] . ' <br><br> ' . $row["date"] . '</a></div>';
                                            }
                                        }
                                    }
                                    echo '<div class="profile_info_details text-start"><p><a href="view-all-notifications" class="see-all">See all</a></p></div>';
                                } else {
                                    echo '<div class="profile_info_details text-start">No Notifications Available</div>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="profile_info ">
                            <img src="../assets/images/client_img.jpg" alt="#">
                            <div class="profile_info_iner notification-box">
                                <p>Advisor</p>
                                <h5 class="text-dark"><?php echo $_SESSION["advisor_username"]; ?></h5>
                                <div class="profile_info_details ">
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