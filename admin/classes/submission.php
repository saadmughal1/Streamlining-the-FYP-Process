<?php

include_once "db.php";

class Submission
{

    private $id, $gid, $title, $date, $time;
    public $connection;

    public function __construct($connection = null, $id = null, $gid = null, $title = null, $date = null, $time = null)
    {
        $this->id = $id;
        $this->gid = $gid;
        $this->title = $title;
        $this->date = $date;
        $this->time = $time;
        $this->connection = $connection;
    }

    public function createSubmission()
    {
        $sql = "INSERT INTO `submission_form`(`gid`, `title`, `date`, `time`) VALUES ($this->gid,'$this->title','$this->date','$this->time')";;
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function createSubmissionByGidInFunction($gid)
    {
        $sql = "INSERT INTO `submission_form`(`gid`, `title`, `date`, `time`) VALUES ($gid,'$this->title','$this->date','$this->time')";;
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function updateSubmission()
    {
        $sql = "UPDATE `submission_form` SET `title`='$this->title',`date`='$this->date',`time`='$this->time' WHERE `id`=$this->id";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Update Query Failed: " . $this->connection->error);
    }

    public function displaySubmissionsByGid($gid)
    {
        $sql = "SELECT sd.*,sf.title FROM `submission_data` sd join `submission_form` sf on sd.sid = sf.id WHERE sd.gid =  $gid;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function displaySubmissionFormsByGid($gid)
    {
        $sql = "SELECT * FROM `submission_form` WHERE `gid` = $gid;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }


    public function displayAllSubmissions()
    {
        $sql = "SELECT * FROM `submission_form` 
        GROUP BY `title`, `date`, `time`;
        ";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function updateAllSubmissions($old_title, $old_date, $old_time)
    {
        $sql = "UPDATE `submission_form` SET `title`='$this->title',`date`='$this->date',`time`='$this->time' WHERE `title`='$old_title' AND `date`='$old_date';";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Update Query Failed: " . $this->connection->error);
    }

    public function displayAllSubmittedSubmissions()
    {
        $sql = "SELECT sg.ptitle,sd.file,sf.title, sd.points,sd.admin_points
        FROM `submission_form` sf
        JOIN `submission_data` sd ON sf.id = sd.sid
        JOIN `student_group` sg ON sg.id = sd.gid
        GROUP BY sf.`title`, sf.`date`, sf.`time`;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function getSubmissionByGid($gid)
    {
        $sql = "SELECT sf.title,sd.* FROM `submission_data` sd join `submission_form` sf on sd.sid = sf.id WHERE sd.`gid` = $gid;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function submitMarks($id, $marks)
    {
        $sql = "UPDATE `submission_data` SET `admin_points`= $marks WHERE `id`= $id;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("UPDATE Query Failed: " . $this->connection->error);
    }



    public function calculateGrade($percentage)
    {
        if ($percentage <= 100 && $percentage >= 86) {
            return "A";
        } else if ($percentage <= 85 && $percentage >= 82) {
            return "A-";
        } else if ($percentage <= 81 && $percentage >= 78) {
            return "B+";
        } else if ($percentage <= 77 && $percentage >= 74) {
            return "B";
        } else if ($percentage <= 73 && $percentage >= 70) {
            return "B-";
        } else if ($percentage <= 69 && $percentage >= 66) {
            return "C+";
        } else if ($percentage <= 65 && $percentage >= 62) {
            return "C";
        } else if ($percentage <= 61 && $percentage >= 58) {
            return "C-";
        } else if ($percentage <= 57 && $percentage >= 54) {
            return "D+";
        } else if ($percentage <= 53 && $percentage >= 50) {
            return "D";
        } else {
            return "F";
        }
    }
}
