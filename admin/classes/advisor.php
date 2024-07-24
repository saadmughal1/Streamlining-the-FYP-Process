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

    public function display()
    {
        $sql = "SELECT * FROM `advisor`;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function getAdvisorByEmail()
    {
        $sql = "SELECT * FROM `advisor` where `email` = '$this->email';";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function getAdvisorById()
    {
        $sql = "SELECT * FROM `advisor` where `id` = '$this->id';";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function getProjectCountOfAllAdvisors()
    {
        $sql = "SELECT a.id,a.username, COUNT(*) as count_projects
        FROM advisor a
        JOIN advisor_group ag ON a.id = ag.aid
        WHERE ag.approved = 1
        GROUP BY a.username;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }


    public function getProjectsByAdvisorId()
    {
        $sql = "select sg.* from advisor_group ag join student_group sg on ag.gid = sg.id where ag.approved = 1 and ag.aid = $this->id;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }


    public function addAdvisor($dept, $domain)
    {
        $sql = "INSERT INTO `advisor`(`username`, `email`, `password`,`dept`,`domain`) VALUES ('$this->username','$this->email','$this->password','$dept','$domain');";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Insert Query Failed: " . $this->connection->error);
    }

    public function updateAdvisor($domain)
    {
        $sql = "UPDATE `advisor` SET `domain` = '$domain', `username`='$this->username',`email`='$this->email',`password`='$this->password' WHERE  `id`=$this->id;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Update Query Failed: " . $this->connection->error);
    }

    public function deleteAdvisor()
    {
        $sql = "DELETE FROM `advisor` WHERE `id` = $this->id;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Delete Query Failed: " . $this->connection->error);
    }


    public function deleteAdvisorProject($aid,$gid)
    {
        echo $sql = "DELETE FROM `advisor_group` WHERE `aid` = $aid AND `gid` = $gid;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }
  

    public function getAdvisorByUsernameEmailAndPassword()
    {
        $sql = "SELECT * FROM `advisor` WHERE `username` = '$this->username' AND `password` = '$this->password' AND `email` = '$this->email'";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }
}
