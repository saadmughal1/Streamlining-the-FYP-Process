<?php

include_once "db.php";

class Advisor
{

    private $id, $username, $email, $password;
    public $connection;

    public function __construct($connection = null, $id = null, $username = null, $email = null, $password = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->connection = $connection;
    }

    public function login()
    {
        $sql = "SELECT *  FROM `advisor` WHERE `email` ='$this->email' AND `password` = '$this->password';";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function getGroupsById()
    {
        $sql = "SELECT sg.*,ag.approved FROM `advisor_group` ag join `student_group` sg on ag.gid = sg.id WHERE ag.`aid` = $this->id;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function getAdvisorById($id)
    {
        $sql = "SELECT * FROM `advisor` WHERE `id` = $id;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function updatePassword($password)
    {
        $sql = "UPDATE `advisor` SET `password`='$password' WHERE `id` = $this->id;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }
}
