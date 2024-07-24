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
                    <h3 class="m-0 nowrap">MY MEETINGS </h3>
                </div>
                <div class="box_right d-flex lms_block">
                    <div class="serach_field-area2">
                        <div class="search_inner">
                        </div>
                    </div>
                </div>
            </div>
            <div class="QA_table overflow-auto">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Group Title</th>
                            <th scope="col">Meeting Title</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        include_once "classes/db.php";
                        include_once "classes/meeting.php";
                        $db = new Db();
                        $meeting = new Meeting($db->getConnection(), null, null, $_SESSION["advisor_id"]);
                        $res = $meeting->myMeetings();
 
                        if ($res->num_rows > 0) {
                            $index = 0;
                            date_default_timezone_set('Asia/Karachi');
                            $currentTime = date("g:i A");
                            $currentDate = date("Y-m-d");
                            $currentTimestamp = strtotime("$currentDate $currentTime");

                            while ($row = $res->fetch_assoc()) {

                                $givenDate = $row["date"];
                                $givenTime = $row["time"];

                                $givenTimestamp = strtotime("$givenDate $givenTime");
                        ?>
                                <tr>
                                    <td><?php echo ++$index; ?></td>
                                    <td>
                                        <?php echo $row["ptitle"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["reason"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["date"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["time"] ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row["status"] == 0) {
                                            echo '<a href="handlers/accept-meeting.php?mid=' . $row["id"] . '&date=' . urlencode($row["date"]) . '&time=' . urlencode($row["time"]) . '&gid=' . urlencode($row["gid"]) . '" class="m-3"><i style="font-size:2rem;" class="bi bi-check text-success"></i></a>';

                                            echo '<button class="m-3 border-0" style="background: none;" onclick="showRejectionPopup(' . $row["id"] . ', ' . $row["gid"] . ')"><i style="font-size:2rem;" class="bi bi-x text-danger"></i></button>';
                                            echo '<script>';
                                            echo 'function showRejectionPopup(mid, gid) {';
                                            echo '    var reason = prompt("Enter the reason for rejection:");';
                                            echo '    if (reason !== null) {';
                                            echo '        window.location.href = "handlers/reject-meeting.php?mid=" + mid + "&reason=" + encodeURIComponent(reason) + "&gid=" + gid;';
                                            echo '    }';
                                            echo '}';
                                            echo '</script>';
                                            echo "<p>Accept or Reject</p>";
                                        } else if ($currentTimestamp >= $givenTimestamp + (10 * 60)) {
                                            echo '<a href="student-attendence?gid=' . urlencode($row["gid"]) . '&mid=' . urlencode($row["id"]) . '" class="m-3"><i style="font-size:2rem;" class="bi bi-check text-success"></i></a>';
                                            // echo '<a href="handlers/reject-meeting.php?mid=' . $row["id"] . '" class="m-3"><i style="font-size:2rem;" class="bi bi-x text-danger"></i></a>';
                                            $reason = "The meeting has been canceled due to no attendees.";
                                            echo '<a href="handlers/reject-meeting.php?mid=' . $row["id"] . '&reason=' . urlencode($reason) . '&gid=' . urlencode($row["gid"]) . '" class="m-3"><i style="font-size:2rem;" class="bi bi-x text-danger"></i></a>';


                                            echo "<p>Has the meeting started?</p>";
                                        } elseif ($currentTimestamp >= $givenTimestamp) {
                                            echo '<a href="student-attendence?mid=' . $row["id"] . '&gid=' . urlencode($row["gid"]) . '" class="m-3"><i style="font-size:2rem;" class="bi bi-box text-primary"></i></a>';
                                        } else {
                                            echo "Meeting will start soon.";
                                        }
                                        ?>
                                    </td>
                                </tr>
                        <?php

                            }
                        } else {
                            echo "<td colspan='5' class='text-center'><b><h2>No Meetings Scheduled</h2></b></td>";
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
    </section>

</body>

<script src="../assets/js/jquery1-3.4.1.min.js"></script>
<script src="../assets/js/metisMenu.js"></script>
<script src="../assets/js/jquery.nice-select.min.js"></script>
<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/tagsinput.js"></script>
<script src="../assets/js/summernote-bs4.js"></script>
<script src="../assets/js/custom.js"></script>

</html>