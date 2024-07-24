<?php

include_once "db.php";

class Attendence
{

    private $id, $mid, $sid, $gid;
    public $connection;

    public function __construct($connection = null, $id = null, $sid = null, $mid = null, $gid = null)
    {
        $this->id = $id;
        $this->mid = $mid;
        $this->sid = $sid;
        $this->gid = $gid;
        $this->connection = $connection;
    }

    public function isAttendenceAvailableByMidAndGid($mid, $sid, $gid)
    {
        $sql = "SELECT * FROM `attendence` WHERE `mid` = $mid AND `sid` = $sid AND `gid` = $gid;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function markAttencence($mid, $sid, $gid)
    {
        $sql = "INSERT INTO `attendence`(`mid`, `sid`,`gid`) VALUES ($mid,$sid,$gid);";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function unMarkAttencence($mid, $sid, $gid)
    {
        $sql = "DELETE FROM `attendence` WHERE `mid` = $mid AND `sid` = $sid AND `gid` = $gid;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function getAttendenceOfStudentGroup($mid, $gid)
    {
        $sql = "SELECT a.sid as stdid from `meeting` m join `attendence` a on m.id = a.mid AND m.gid = a.gid WHERE a.mid = $mid AND a.gid = $gid;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }
}
