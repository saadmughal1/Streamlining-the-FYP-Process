<?php
include_once "classes/db.php";
include_once "classes/advisor.php";
include_once "classes/student_group.php";
$db = new Db();

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

  <?php
  $student_group = new Student_group($db->getConnection());
  if ($student_group->getStudentGroupByRegNo($_SESSION["student_roll_no"])->num_rows > 0) {
    header("LOCATION: ./");
    exit();
  }
  ?>

  <section class="main_content dashboard_part">

    <?php include_once "partials/_navbar.php"; ?>


    <div class="white_box QA_section card_height_100">
      <div class="white_box_tittle list_header m-0 align-items-center mb-3">
        <div class="main-title mb-sm-15">
          <h3 class="m-0 nowrap">Make Group</h3>
        </div>
      </div>

      <div class="form-container">
        <div class="form-header">
          <span class="form-title">FORM</span>
        </div>
        <div class="form-body">
          <!-- Your form elements go here -->
        </div>
      </div>
      <br>

      <div class="centerForm">
        <form class="projectForm" method="POST" action="handlers/create-group.php" enctype="multipart/form-data">

          <div class="form-group">
            <label for="projectTitle">Project Title</label>
            <input type="text" required name="ptitle" class="form-control inputField" id="projectTitle" placeholder="Enter Project Title" value="<?php if (isset($_GET["ptitle"])) echo $_GET["ptitle"]; ?>">
          </div>

          <div class="form-group formRow">
            <label for="projectIdea">Project Idea</label>
            <textarea required name="idea" class="form-control inputField" id="projectIdea" placeholder="Enter Project Idea" cols="30" rows="10"><?php if (isset($_GET["idea"])) echo $_GET["idea"]; ?></textarea>
          </div>
          <div class="student_entry formRow">
            <div class="form-group">
              <label for="registrationNumber1">Registration Number 1</label>
              <input type="hidden" name="reg1" value="<?php echo $_SESSION["student_roll_no"]; ?>">
              <input required type="text" class="form-control inputField" id="registrationNumber1" placeholder="Enter Registration Number" value="<?php echo $_SESSION["student_roll_no"]; ?>" disabled>

            </div>

            <div class="form-group">
              <label for="registrationNumber2">Registration Number 2</label>
              <input type="text" required name="reg2" class="form-control inputField" id="registrationNumber2" placeholder="Enter Registration Number">
            </div>

            <div class="form-group">
              <label for="registrationNumber3">Registration Number 3</label>
              <input type="text" required name="reg3" class="form-control inputField" id="registrationNumber3" placeholder="Enter Registration Number">
            </div>

            <div class="form-group">
              <label for="registrationNumber4">Registration Number 4 (optional)</label>
              <input type="text" name="reg4" class="form-control inputField" id="registrationNumber4" placeholder="Enter Registration Number">
            </div>

            <div class="form-group">
              <label for="file-doc">Attach File</label>
              <input type="file" name="file" class="form-control inputField" id="file-doc">
            </div>
            <br>
            <button type="submit" class="but">Submit Details</button>
            <h6 class="text-danger text-center">
              <?php if (isset($_GET["err"]))
                echo $_GET["err"]; ?>
            </h6>
        </form>
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