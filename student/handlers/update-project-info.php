<?php

include_once __DIR__ . "/../classes/db.php";
include_once __DIR__ . "/../classes/student_group.php";
include_once __DIR__ . "/../classes/notifications.php";
include_once __DIR__ . "/../classes/advisor_group.php";

if (isset($_POST["gid"]) && isset($_POST["ptitle"]) && isset($_POST["idea"]) && isset($_FILES["file"]) && isset($_POST["old_file"])) {
    $gid = $_POST["gid"];
    $ptitle = $_POST["ptitle"];
    $idea = $_POST["idea"];

    $old_file = $_POST["old_file"];
    $fileData = $_FILES["file"];

    if ($fileData["size"] > 0) {
        $extension = pathinfo($fileData['name'], PATHINFO_EXTENSION);

        $milliseconds = round(microtime(true) * 1000);
        $newFileName = $milliseconds . '.' . $extension;

        $allowedTypes = ['pdf', 'docx'];

        if (in_array($extension, $allowedTypes)) {
            $uploadPath = '../../assets/documents/' . $newFileName;
            move_uploaded_file($fileData['tmp_name'], $uploadPath);
            $filename = $newFileName;
            unlink("../../assets/documents/" . $old_file);
        } else {
            header("LOCATION: ../update-project-info?err=Only pdf and word files are allowed");
            exit();
        }
    } else {
        $filename = $old_file;
    }

    $db = new Db();

    $ptitle = mysqli_real_escape_string($db->getConnection(), $ptitle);
    $idea = mysqli_real_escape_string($db->getConnection(), $idea);

    $student_group = new Student_group($db->getConnection(), $gid, $idea, $ptitle);


    $advisor_group = new Advisor_group($db->getConnection(), null, null, $gid);
    $res = $advisor_group->getAdvisorByGroupId();
    if ($res->num_rows > 0) {
        $msg = $ptitle . ": Updated their project info.";
        $aid = $res->fetch_assoc()["aid"];
        $notification = new Notifications($db->getConnection(), null, $msg, $aid, $gid, 0, 0);
        $notification->sendNotification();
    }







    $student_group->updateProjectInfo($filename);
    if ($res->num_rows > 0) {
        header("LOCATION: ../");
    } else {
        header("LOCATION: ../choose-advisor");
    }
}
