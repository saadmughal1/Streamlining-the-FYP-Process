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
                    <h3 class="m-0 nowrap">ADD NEW ADVISOR</h3>
                </div>
            </div>
            <div class="QA_table overflow-auto">
                <div class="centerForm">
                    <form class="projectForm" method="POST" action="handlers/add-advisor.php">
                        <div class="form-group mb-3">
                            <label for="username">Advisor Username</label>
                            <input type="text" name="username" class="form-control inputField" id="username" placeholder="Username">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Advisor Email</label>
                            <input type="email" name="email" class="form-control inputField" id="email" placeholder="Email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Advisor Password</label>
                            <input type="text" name="password" class="form-control inputField" id="password" placeholder="Password">
                        </div>

                        <div class="form-group mb-3">

                            <?php
                            include_once "classes/db.php";
                            include_once "classes/department.php";

                            $db = new Db();
                            $department = new Department($db->getConnection());

                            $res = $department->display();

                            ?>
                            <select name="dept" id="" required class="form-control inputField">
                                <option value="" disabled selected>Select Department</option>
                                <?php
                                while ($row = $res->fetch_assoc()) {
                                    echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="password">Add Domain</label>
                            <textarea name="domain" id="domain" cols="30" rows="3" class="form-control form-control-lg" placeholder="domain..."></textarea>
                        </div>

                        <h6 class="text-danger ">
                            <?php if (isset($_GET["err"]))
                                echo $_GET["err"]; ?>
                        </h6>
                        <button type="submit" class="but">Add</button>
                    </form>
                </div>
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