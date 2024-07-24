<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/student.php";
include_once __DIR__ . "/../classes/student_group.php";

if (isset($_POST["ptitle"]) && isset($_POST["idea"]) && isset($_POST["reg1"]) && isset($_POST["reg2"]) && isset($_POST["reg3"]) && isset($_POST["reg4"]) && isset($_FILES["file"])) {
    $ptitle = $_POST["ptitle"];
    $idea = $_POST["idea"];

    $reg1 = $_POST["reg1"];
    $reg2 = $_POST["reg2"];
    $reg3 = $_POST["reg3"];
    $reg4 = $_POST["reg4"];

    $fileData = $_FILES["file"];

    $extension = pathinfo($fileData['name'], PATHINFO_EXTENSION);

    $milliseconds = round(microtime(true) * 1000);
    $newFileName = $milliseconds . '.' . $extension;

    $allowedTypes = ['pdf', 'docx'];

    if (in_array($extension, $allowedTypes)) {
        $uploadPath = '../../assets/documents/' . $newFileName;
        move_uploaded_file($fileData['tmp_name'], $uploadPath);
    } else {
        header("LOCATION: ../make-group?err=Only pdf and word files are allowed&idea=" . $idea . "&ptitle=" . $ptitle);
        exit();
    }

    $db = new Db();

    if ($reg1 == $reg2 || $reg1 == $reg3 || $reg1 == $reg4) {
        header("LOCATION: ../make-group?err=Registration No's are the same&idea=" . $idea . "&ptitle=" . $ptitle);
        exit();
    }

    if (!empty($reg2) && !empty($reg3) && ($reg2 == $reg3) || !empty($reg2) && !empty($reg4) && ($reg2 == $reg4) || !empty($reg3) && !empty($reg4) && ($reg3 == $reg4)) {
        header("LOCATION: ../make-group?err=Registration No's are the same&idea=" . $idea . "&ptitle=" . $ptitle);
        exit();
    }

    $student = new Student($db->getConnection());

    $ptitle = mysqli_real_escape_string($db->getConnection(), $ptitle);
    $idea = mysqli_real_escape_string($db->getConnection(), $idea);

    $student_group = new Student_group($db->getConnection(), null, $idea, $ptitle);

    if (!empty($reg2)) {
        if ($student->getStudentByRollNo($reg2)->num_rows == 0) {
            header("LOCATION: ../make-group?err=" . $reg2 . " Not Available.&idea=" . $idea . "&ptitle=" . $ptitle);
            exit();
        } else {
            if ($student_group->getStudentGroupByRegNo($reg2)->num_rows > 0) {
                header("LOCATION: ../make-group?err=" . $reg2 . " Already have group&idea=" . $idea . "&ptitle=" . $ptitle);
                exit();
            }
        }
    }

    if (!empty($reg3)) {
        if ($student->getStudentByRollNo($reg3)->num_rows == 0) {
            header("LOCATION: ../make-group?err=" . $reg3 . " Not Available.&idea=" . $idea . "&ptitle=" . $ptitle);
            exit();
        } else {
            if ($student_group->getStudentGroupByRegNo($reg3)->num_rows > 0) {
                header("LOCATION: ../make-group?err=" . $reg3 . " Already have group&idea=" . $idea . "&ptitle=" . $ptitle);
                exit();
            }
        }
    }


    if (!empty($reg4)) {
        if ($student->getStudentByRollNo($reg4)->num_rows == 0) {
            header("LOCATION: ../make-group?err=" . $reg4 . " Not Available.&idea=" . $idea . "&ptitle=" . $ptitle);
            exit();
        } else {
            if ($student_group->getStudentGroupByRegNo($reg4)->num_rows > 0) {
                header("LOCATION: ../make-group?err=" . $reg4 . " Already have group&idea=" . $idea . "&ptitle=" . $ptitle);
                exit();
            }
        }
    }

    $student_group->create_group($reg1, $reg2, $reg3, $reg4, $newFileName);
    header("LOCATION: ../");
}
