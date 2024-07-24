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
            <div class="white_box_tittle list_header m-0 align-items-center">
                <div class="main-title mb-sm-15">
                    <h3 class="m-0 nowrap">Meeting agenda</h3>
                </div>
                <div class="box_right d-flex lms_block">
                    <!-- Search field area can be included here if needed -->
                </div>
            </div>
            <div class="QA_table">
                <!-- Table starts here -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Agenda</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="agenda">Agenda:</label>
                                    <input type="text" class="inputField" id="agenda" name="agenda" required>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="date">Date:</label>
                                    <input type="date" class="inputField" id="date" name="date" required>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="time">Time:</label>
                                    <input type="time" class="inputField" id="time" name="time" required>
                                </div>
                            </td>
                            <td>
                                <div class="button_1">
                                    <button class="but">SEND</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Table ends here -->
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