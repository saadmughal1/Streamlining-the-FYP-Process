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

    public function getAllGroups()
    {
        $sql = "SELECT * from `student_group`";
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

    public function onGoingProjects()
    {
        $sql = "SELECT sg.id as gid,sg.group_id,sg.reg1,sg.reg2,sg.reg3,sg.reg4,sg.ptitle, a.id as aid, a.username as advisorUsername FROM `advisor_group` ag join `student_group` sg on ag.gid = sg.id join `advisor` a on a.id = ag.aid where ag.approved = 1";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }


    public function setGroupId($group_id, $gid)
    {
        $sql = "UPDATE `student_group` SET `group_id`='$group_id' WHERE `id`= $gid";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function search($group_id)
    {
        $sql = "SELECT sg.*,a.id as aid,a.username FROM `student_group` sg join `advisor_group` ag on sg.id = ag.gid join `advisor` a on a.id = ag.aid where sg.group_id = '$group_id'";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function displayGroup()
    {
        $sql = "SELECT sg.* FROM `student_group` sg join `advisor_group` ag on sg.id = ag.gid WHERE ag.approved = 1";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }
}
