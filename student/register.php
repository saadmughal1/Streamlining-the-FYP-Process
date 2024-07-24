<?php
session_start();
if (isset($_SESSION["student_id"])) {
    header("Location: ./");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Flow - Student Register</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function validateRegistrationNumber() {
            var regNumberPattern = /^L1[SF]\d{2}[A-Z]{4}\d{4}$/i;
            var rollNoInput = document.getElementById("roll_no").value;
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
                    url: "handlers/register.php",
                    data: {
                        username: usernameInput,
                        roll_no: rollNoInput,
                        password: passwordInput,
                        department: dept,
                        cgpa: cgpa,
                        interest: interest,
                        credit_hours: credit_hours
                    },
                    success: function(response) {
                        if (response === "success") {
                            window.location.href = "./";
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
</head>

<body>

    <div class="login-container d-flex align-items-center justify-content-center">
        <form id="registrationForm" class="login-form text-center">
            <img src="../assets/images/logo.png" alt="LOGO">
            <h2 class="mb-5">Student Register</h2>
            <div class="form-group">
                <input type="text" id="username" name="username" class="form-control rounded-pill form-control-lg" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="text" id="roll_no" name="roll_no" class="form-control rounded-pill form-control-lg" placeholder="Registration No" required>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" class="form-control rounded-pill form-control-lg" placeholder="Password" required>
            </div>
            <div class="form-group mb-3">

                <?php
                include_once "classes/db.php";
                include_once "classes/department.php";

                $db = new Db();
                $department = new Department($db->getConnection());

                $res = $department->display();

                ?>
                <select name="dept" id="dept" required class="form-control inputField" style="border-radius:5rem;">
                    <option value="" disabled selected>Select Department</option>
                    <?php
                    while ($row = $res->fetch_assoc()) {
                        echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <input type="number" id="cgpa" name="cgpa" class="form-control rounded-pill form-control-lg" placeholder="CGPA" required>
            </div>

            <div class="form-group">
                <input type="number" id="credit_hours" name="credit_hours" class="form-control rounded-pill form-control-lg" placeholder="Credit Hours" required>
            </div>

            <div class="form-group">
                <textarea name="interest" id="interest" cols="30" rows="3" class="form-control form-control-lg" placeholder="Enter your interests or domain..."></textarea>
            </div>

            <button type="button" onclick="validateRegistrationNumber()" class="btn mt-3 mb-4 rounded-pill btn-lg btn-custom btn-block text-uppercase">Register</button>
            <h6 id="error-message" class="text-danger text-center"></h6>
            <a href="login" style="font-size:0.8rem;">Already Have an Account? Login</a>
        </form>
    </div>

    <!-- Link to Bootstrap JS and Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>