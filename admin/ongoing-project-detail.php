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
        <div class="white_box QA_section card_height_100">
            <div class="white_box_tittle list_header m-0 align-items-center mb-3">
                <div class="main-title mb-sm-15">
                    <h3 class="m-0 nowrap">Attendence Record</h3>
                </div>
            </div>

            <div class="QA_table overflow-auto">

                <?php
                $isAdenda = false;
                include_once "classes/db.php";
                include_once "classes/student_group.php";
                include_once "classes/student.php";
                include_once "classes/attendence.php";

                $db = new Db();

                $student_group = new Student_group($db->getConnection(), $_GET["gid"]);
                $stdGroupRes = $student_group->getStudentGroupByGid()->fetch_assoc();

                $reg1 = $stdGroupRes["reg1"];
                $reg2 = $stdGroupRes["reg2"];
                $reg3 = $stdGroupRes["reg3"];
                $reg4 = $stdGroupRes["reg4"];

                $stdRegNo = array();

                if (!empty($reg1)) {
                    $stdRegNo[] = $reg1;
                }

                if (!empty($reg2)) {
                    $stdRegNo[] = $reg2;
                }

                if (!empty($reg3)) {
                    $stdRegNo[] = $reg3;
                }

                if (!empty($reg4)) {
                    $stdRegNo[] = $reg4;
                }

                $student = new Student($db->getConnection());

                $stdRecord = array();
                foreach ($stdRegNo as $regNo) {
                    $studentResult = $student->getStudentByRollNo($regNo);
                    $row = $studentResult->fetch_assoc();
                    unset($row['password']);
                    $stdRecord[] = $row;
                }

                $attendence = new Attendence($db->getConnection());
                $res = $attendence->getAttendenceOfStudentGroup($_GET["mid"], $_GET["gid"]);

                $statusArray = array();

                foreach ($stdRecord as $student) {
                    $statusArray[] = array(
                        'id' => $student['id'],
                        'username' => $student['username'],
                        'roll_no' => $student['roll_no'],
                        'status' => 'Absent',
                    );
                }
                while ($row = $res->fetch_assoc()) {
                    $stdId = $row['stdid'];
                    foreach ($statusArray as &$student) {
                        if ($student['id'] == $stdId) {
                            $student['status'] = 'Present';
                            break;
                        }
                    }
                }
                ?>

                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">student name</th>
                            <th scope="col">roll no</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if ($res->num_rows > 0) {
                            $index = 0;
                            for ($i = 0; $i < count($statusArray); $i++) {
                                $isAdenda = true;
                        ?>
                                <tr>
                                    <td><?php echo ++$index; ?></td>
                                    <td><?php echo $statusArray[$i]['username']; ?></td>
                                    <td><?php echo $statusArray[$i]['roll_no']; ?></td>
                                    <td><?php echo $statusArray[$i]['status']; ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'><b><h2>All Students were Absent.</h2></b></td></tr>";
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>



        <div class="white_box QA_section card_height_100">
            <div class="white_box_tittle list_header m-0 align-items-center mb-3">
                <div class="main-title mb-sm-15">
                    <h3 class="m-0 nowrap">Meeting Agenda</h3>
                </div>
            </div>

            <div class="QA_table overflow-auto">

                <?php
                include_once "classes/agenda.php";
                $agenda = new Agenda($db->getConnection());

                ?>

                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">student name</th>
                            <th scope="col">Agenda</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (count($stdRecord) > 0) {
                            $index = 0;
                            for ($i = 0; $i < count($stdRecord); $i++) {
                                $res = $agenda->getAgendaBySidGidMid($_GET["mid"], $stdRecord[$i]["id"], $_GET["gid"]);
                                if ($res->num_rows > 0) {
                                    $row = $res->fetch_assoc();

                        ?>
                                    <tr>
                                        <td><?php echo ++$index; ?></td>
                                        <td><?php echo $stdRecord[$i]['username']; ?></td>
                                        <td><?php echo $row['agenda']; ?></td>
                                    </tr>
                        <?php
                                } else {
                                    echo "<tr>";
                                    echo "<td>" . ++$index . "</td>";
                                    echo "<td>" . $stdRecord[$i]['username'] . "</td>";
                                    echo "<td class='text-danger'>Not Filled</td>";
                                    echo "</tr>";
                                }
                            }
                        } else {
                            echo "<tr><td colspan='3' class='text-center'><b><h2>No Agenda Available.</h2></b></td></tr>";
                        }
                        ?>
                    </tbody>

                </table>
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