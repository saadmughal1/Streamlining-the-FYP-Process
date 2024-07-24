<?php

include_once "db.php";

class Meeting
{

    private $id, $aid, $gid, $reason, $date, $time, $status;
    public $connection;

    public function __construct($connection = null, $id = null, $gid = null, $aid = null, $reason = null, $date = null, $time = null, $status = null)
    {
        $this->id = $id;
        $this->aid = $aid;
        $this->gid = $gid;
        $this->reason = $reason;
        $this->date = $date;
        $this->time = $time;
        $this->status = $status;
        $this->connection = $connection;
    }

    public function myMeetings()
    {
        $sql = "SELECT m.*,sg.ptitle FROM `meeting` m join `student_group` sg on m.gid = sg.id  where m.aid = $this->aid AND status in (0,1);";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function scheduleMeeting()
    {
        $sql = "INSERT INTO `meeting`(`gid`, `aid`, `reason`, `date`, `time`, `status`) VALUES ('$this->gid','$this->aid','$this->reason','$this->date','$this->time',$this->status);";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Insert Query Failed: " . $this->connection->error);
    }
    public function acceptMeeting()
    {
        $sql = "UPDATE `meeting` SET `status`= 1 WHERE `id`=$this->id;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Update Query Failed: " . $this->connection->error);
    }

    public function rejectMeeting()
    {
        $sql = "UPDATE `meeting` SET `status`= 2 WHERE `id`=$this->id;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Update Query Failed: " . $this->connection->error);
    }

    public function doneMeeting()
    {
        $sql = "UPDATE `meeting` SET `status`= 3 WHERE `id`=$this->id;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Update Query Failed: " . $this->connection->error);
    }

    public function getMeetingByGidAndAid()
    {
        $sql = "SELECT * FROM `meeting` WHERE aid = $this->aid and gid = $this->gid and status = 3;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }
}
