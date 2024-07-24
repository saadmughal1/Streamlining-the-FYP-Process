<?php

include_once "db.php";

class Student_group
{

    private $id, $idea, $ptitle, $reg1, $reg2, $reg3;
    public $connection;

    public function __construct($connection = null, $id = null, $idea = null, $ptitle = null, $reg1 = null, $reg2 = null, $reg3 = null)
    {
        $this->id = $id;
        $this->idea = $idea;
        $this->ptitle = $ptitle;
        $this->reg1 = $reg1;
        $this->reg2 = $reg2;
        $this->reg3 = $reg3;
        $this->connection = $connection;
    }

    public function getStudentGroupByRegNo($reg)
    {
        $sql = "SELECT * FROM `student_group` WHERE `reg1` = '$reg' OR `reg2` = '$reg' OR `reg3` = '$reg' OR `reg4` = '$reg';";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function getStudentGroupByGid()
    {
        // $sql = "SELECT DISTINCT sg.* FROM `notifications` n join `student_group` sg on n.gid = sg.id where n.aid = $aid;";
        $sql = "SELECT * from `student_group` where id = $this->id";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }
}
