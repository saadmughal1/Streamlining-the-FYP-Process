<?php

include_once "db.php";

class Student_group
{

    private $id, $idea, $ptitle, $reg1, $reg2, $reg3, $reg4;
    public $connection;

    public function __construct($connection = null, $id = null, $idea = null, $ptitle = null, $reg1 = null, $reg2 = null, $reg3 = null, $reg4 = null)
    {
        $this->id = $id;
        $this->idea = $idea;
        $this->ptitle = $ptitle;
        $this->reg1 = $reg1;
        $this->reg2 = $reg2;
        $this->reg3 = $reg3;
        $this->reg4 = $reg4;
        $this->connection = $connection;
    }

    public function create_group($reg1 = null, $reg2 = null, $reg3 = null, $reg4 = null, $filename = null)
    {
        $sql = "INSERT INTO `student_group`(`reg1`, `reg2`, `reg3`,`reg4`,`idea`,`ptitle`,`filename`) VALUES ('$reg1','$reg2','$reg3','$reg4','$this->idea','$this->ptitle','$filename')";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Insert Query Failed: " . $this->connection->error);
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


    public function updateProjectInfo($filename)
    {
        $sql = "UPDATE `student_group` SET `idea`='$this->idea',`ptitle`='$this->ptitle' , `filename` = '$filename' WHERE `id`=$this->id;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }


    public function getStudentGroupByGid()
    {
        $sql = "SELECT * FROM `student_group` WHERE id = $this->id;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }
}
