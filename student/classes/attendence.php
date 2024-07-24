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
