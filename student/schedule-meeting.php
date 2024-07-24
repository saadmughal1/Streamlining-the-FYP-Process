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
          <h3 class="m-0 nowrap">Meeting Scheduling</h3>
        </div>
        <a href="previous-meetings" class="but mb-2">Previous Meetings</a>
      </div>

      <div class="QA_table">
        <div class="main_content_iner">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Agenda</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <form action="handlers/schedule-meeting.php" method="POST">
                <tr>
                  <td>
                    <div class="form-group">
                      <label for="reason">Meeting Agenda:</label>
                      <input required type="text" class="inputField" id="reason" name="reason" />
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label for="date">Date:</label>
                      <input required type="date" class="inputField" id="date" name="date" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" />
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label for="time">Time:</label>
                      <input required type="time" class="inputField" id="time" name="time" />
                    </div>
                  </td>
                  <td>
                    <div class="button_1">
                      <button class="but p-0">REQUEST</button>
                    </div>
                  </td>
                </tr>
              </form>
            </tbody>
          </table>
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