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

    public function getSubmissions($gid)
    {
        $sql = "SELECT * FROM `submission_form` WHERE gid = $gid;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Insert Query Failed: " . $this->connection->error);
    }

    public function isAlreadySubmitted($gid, $sid)
    {
        $sql = "SELECT * FROM `submission_data` where `sid` = $sid AND `gid` = $gid";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function submitData($gid, $sid, $fileData)
    {
        $sql = "INSERT INTO `submission_data`(`gid`, `sid`, `file`) VALUES ($gid,$sid,'$fileData');";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Insert Query Failed: " . $this->connection->error);
    }
}
