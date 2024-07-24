<?php

include_once "db.php";

class Admin
{

    private $id, $username, $password;
    public $connection;

    public function __construct($connection = null, $id = null, $username = null, $password = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->connection = $connection;
    }

    public function login()
    {
        $sql = "SELECT *  FROM `admin` WHERE `username` ='$this->username' AND `password` = '$this->password';";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function approveProject($gid)
    {
        $sql = "UPDATE `advisor_group` SET `approved`= 1 WHERE `gid`= $gid;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }


    public function withdraw($gid, $aid)
    {
        $sql1 = "DELETE FROM `advisor_group` WHERE `gid` = $gid AND `aid` = $aid";
        if ($this->connection->query($sql1) === FALSE) {
            die("DELETE Query Failed: " . $this->connection->error);
        }

        $sql2 = "DELETE FROM `agenda` WHERE `gid` = $gid";
        if ($this->connection->query($sql2) === FALSE) {
            die("DELETE Query Failed: " . $this->connection->error);
        }

        $sql3 = "DELETE FROM `attendence` WHERE `gid` = $gid";
        if ($this->connection->query($sql3) === FALSE) {
            die("DELETE Query Failed: " . $this->connection->error);
        }

        $sql4 = "DELETE FROM `meeting` WHERE `gid` = $gid";
        if ($this->connection->query($sql4) === FALSE) {
            die("DELETE Query Failed: " . $this->connection->error);
        }

        $sql5 = "DELETE FROM `notifications` WHERE `gid` = $gid AND `aid` = $aid";
        if ($this->connection->query($sql5) === FALSE) {
            die("DELETE Query Failed: " . $this->connection->error);
        }

        echo $sql6 = "DELETE FROM `student_group` WHERE `id` = $gid";
        if ($this->connection->query($sql6) === FALSE) {
            die("DELETE Query Failed: " . $this->connection->error);
        }

        $sql7 = "DELETE FROM `submission_data` WHERE `gid` = $gid";
        if ($this->connection->query($sql7) === FALSE) {
            die("DELETE Query Failed: " . $this->connection->error);
        }

        $sql8 = "DELETE FROM `submission_form` WHERE `gid` = $gid";
        if ($this->connection->query($sql8) === FALSE) {
            die("DELETE Query Failed: " . $this->connection->error);
        }

        return true; 
    }
}
