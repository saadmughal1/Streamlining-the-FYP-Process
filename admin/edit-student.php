<!DOCTYPE html>
<html lang="en">

<head>

    <title>PROJECT-FLOW</title>

    <link rel="stylesheet" href="../assets/css/bootstrap1.min.css" />

    <link rel="stylesheet" href="../assets/css/themify-icons.css" />

    <link rel="stylesheet" href="../assets/css/metisMenu.css">

    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


</head>



<?php
include_once "classes/db.php";
include_once "classes/student.php";
$db = new Db();

$student = new Student($db->getConnection(), $_GET["sid"]);
$sres = $student->getStudentById()->fetch_assoc();

?>


<body class="crm_body_bg">
    <?php include_once "partials/_sidebar.php"; ?>
    <section class="main_content dashboard_part">
        <?php include_once "partials/_navbar.php"; ?>
        <!-- Main content goes here -->
        <div class="white_box QA_section card_height_100">
            <div class="white_box_tittle list_header m-0 align-items-center mb-3">
                <div class="main-title mb-sm-15">
                    <h3 class="m-0 nowrap">EDIT STUDENT</h3>
                </div>
            </div>
            <div class="QA_table overflow-auto">
                <div class="centerForm">
                    <form class="projectForm" method="POST" action="handlers/add-advisor.php">
                        <div class="form-group mb-3">
                            <label for="username">Student Username</label>
                            <input type="text" id="username" name="username" class="form-control rounded-pill form-control-lg" placeholder="Username" required value="<?php echo $sres["username"]; ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="roll_no">Student Registration No</label>
                            <input type="hidden" id="old_reg" value="<?php echo $sres["roll_no"]; ?>">
                            <input type="text" id="roll_no" name="roll_no" class="form-control rounded-pill form-control-lg" placeholder="Registration No" required value="<?php echo $sres["roll_no"]; ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Student Password</label>
                            <input type="text" id="password" name="password" class="form-control rounded-pill form-control-lg" placeholder="Password" required value="<?php echo $sres["password"]; ?>">
                        </div>

                        <div class="form-group mb-3">

                            <?php
                            include_once "classes/db.php";
                            include_once "classes/department.php";

                            $db = new Db();
                            $department = new Department($db->getConnection());

                            $res = $department->display();

                            ?>
                            <select name="dept" id="dept" required class="form-control inputField">
                                <?php
                                while ($row = $res->fetch_assoc()) {
                                    if ($row["name"] == $sres["dept"]) {
                                        echo '<option selected value="' . $row["name"] . '">' . $row["name"] . '</option>';
                                    } else {
                                        echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cgpa">Student CGPA</label>
                            <input type="number" id="cgpa" name="cgpa" class="form-control rounded-pill form-control-lg" placeholder="CGPA" required value="<?php echo $sres["cgpa"]; ?>">
                        </div>

                        <div class="form-group">
                            <label for="credit_hours">Student Credit Hours</label>
                            <input type="number" id="credit_hours" name="credit_hours" class="form-control rounded-pill form-control-lg" placeholder="Credit Hours" required value="<?php echo $sres["credit_hours"]; ?>">
                        </div>

                        <div class="form-group">
                            <label for="cgpa">Student Interests</label>
                            <textarea name="interest" id="interest" cols="30" rows="3" class="form-control form-control-lg" placeholder="Enter interests or domain..."><?php echo $sres["interest"]; ?></textarea>
                        </div>

                        <h6 id="error-message" class="text-danger text-center"></h6>
                        <button type="button" onclick="validateRegistrationNumber()" class="but">Add</button>
                    </form>
                </div>
            </div>
        </div>

    </section>


    <script>
        function validateRegistrationNumber() {
            var regNumberPattern = /^L1[SF]\d{2}[A-Z]{4}\d{4}$/i;
            var rollNoInput = document.getElementById("roll_no").value;
            var old_reg = document.getElementById("old_reg").value;
            var dept = document.getElementById("dept").value;
            var credit_hours = document.getElementById("credit_hours").value;

            var cgpa = document.getElementById("cgpa").value;
            var interest = document.getElementById("interest").value;


            var errorMessageElement = document.getElementById("error-message");

            var usernameInput = $("#username").val();
            var passwordInput = $("#password").val();

            if (!usernameInput || !rollNoInput || !passwordInput || !cgpa || !interest) {
                errorMessageElement.innerText = "All fields are required";
                return;
            }


            if (cgpa < 0 || cgpa > 4) {
                errorMessageElement.innerText = "Add valid cgpa";
                return;
            }

            if (credit_hours < 90) {
                errorMessageElement.innerText = "Currently you are not elligible for registration.";
                return;
            }


            if (regNumberPattern.test(rollNoInput)) {
                errorMessageElement.innerText = "";

                $.ajax({
                    type: "POST",
                    url: "handlers/edit-student.php",
                    data: {
                        username: usernameInput,
                        roll_no: rollNoInput,
                        old_reg_no: old_reg,
                        password: passwordInput,
                        department: dept,
                        cgpa: cgpa,
                        interest: interest,
                        id: <?php echo $_GET["sid"]; ?>,
                        credit_hours: credit_hours
                    },
                    success: function(response) {
                        if (response === "success") {
                            window.location.href = "./display-students";
                        } else {
                            errorMessageElement.innerText = response;
                        }
                    },
                    error: function(error) {
                        console.log("AJAX Error:", error);
                    }
                });
            } else {
                errorMessageElement.innerText = "Invalid registration number";
            }
        }
    </script>


    <script src="../assets/js/jquery1-3.4.1.min.js"></script>

    <script src="../assets/js/metisMenu.js"></script>

    <script src="../assets/js/jquery.nice-select.min.js"></script>

    <script src="../assets/js/owl.carousel.min.js"></script>

    <script src="../assets/js/tagsinput.js"></script>

    <script src="../assets/js/summernote-bs4.js"></script>

    <script src="../assets/js/custom.js"></script>
</body>

</html>