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


    public function login()
    {
        $sql = "SELECT * FROM `students` WHERE `roll_no` = '$this->roll_no' AND `password` = '$this->password';";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function register($dept, $cgpa, $interest, $credit_hours)
    {
        $sql = "INSERT INTO `students`(`username`, `roll_no`, `password`,`dept`,`cgpa`,`interest`,`credit_hours`) VALUES ('$this->username','$this->roll_no','$this->password','$dept','$cgpa','$interest','$credit_hours')";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Insert Query Failed: " . $this->connection->error);
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

    public function getStudentById()
    {
        $sql = "SELECT * FROM `students` WHERE `id` = '$this->id';";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }


    public function updatePassword($new_password)
    {
        $sql = "UPDATE `students` SET `password`='$new_password' WHERE `id`= $this->id;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }
}
