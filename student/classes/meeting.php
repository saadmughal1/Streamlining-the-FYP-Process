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
    public function scheduleMeeting()
    {
        $sql = "INSERT INTO `meeting`(`gid`, `aid`, `reason`, `date`, `time`, `status`) VALUES ('$this->gid','$this->aid','$this->reason','$this->date','$this->time',$this->status);";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Insert Query Failed: " . $this->connection->error);
    }


    public function studentScheduledMeetings()
    {
        $sql = "SELECT * FROM `meeting` WHERE gid = $this->gid and status = 1";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Insert Query Failed: " . $this->connection->error);
    }
 
    public function previousMeetings()
    {
        $sql = "SELECT * FROM `meeting` WHERE gid = $this->gid and status = 3";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function attendenceByMeetingId()
    {
        $sql = "SELECT * FROM `attendence` WHERE mid = $this->id";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }
}
