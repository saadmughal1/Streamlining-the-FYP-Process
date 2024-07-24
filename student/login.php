<?php
session_start();
if(isset($_SESSION["student_id"])){
    header("Location: ./");
   exit() ;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Flow - Student Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

    <div class="login-container d-flex align-items-center justify-content-center">
        <form class="login-form text-center" method="POST" action="handlers/login.php">
            <img src="../assets/images/logo.png" alt="LOGO">
            <h2 class="mb-5">Student Login</h2>
            <div class="form-group">
                <input type="text" name="roll_no" class="form-control rounded-pill form-control-lg" placeholder="Registration No">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control rounded-pill form-control-lg" placeholder="Password">
            </div>

            <button type="submit" class="btn mt-3 mb-4 rounded-pill btn-lg btn-custom btn-block text-uppercase">Login</button>
            <h6 class="text-danger text-center">
                <?php if (isset($_GET["err"]))
                    echo $_GET["err"]; ?>
            </h6>
            <!-- <a href="register" style="font-size:0.8rem;">Don't Have an Account? Register</a> -->
        </form>
    </div>

    <!-- Link to Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>