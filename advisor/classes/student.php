<?php

include_once "db.php";

class Student
{

    private $id, $username, $roll_no, $password;
    public $connection;

    public function __construct($connection = null, $id = null, $username = null, $roll_no = null, $password = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->roll_no = $roll_no;
        $this->password = $password;
        $this->connection = $connection;
    }

     
    public function getStudentByRollNo($roll_no)
    {
        $sql = "SELECT * FROM `students` WHERE `roll_no` = '$roll_no';";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

   
}
