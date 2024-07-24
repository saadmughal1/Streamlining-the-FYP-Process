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
