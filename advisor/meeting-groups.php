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
                    <h3 class="m-0 nowrap">SCHEDULE MEETING</h3>
                </div>
            </div>
            <div class="QA_table overflow-auto">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Group Title</th>
                            <th scope="col"></th>
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
                                        <a href="schedule-meeting?gid=<?php echo $row["id"]; ?>" class="but">Schedule</a>
                                    </td>
                                </tr>
                        <?php

                            }
                        } else {
                            echo "<td colspan='5' class='text-center'><b><h2>No Groups Available</h2></b></td>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>


</body>

</html>