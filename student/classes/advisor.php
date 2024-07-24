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


    public function getAdvisorTotalSlots()
    {
        $sql = "SELECT a.id, a.username, a.dept,a.domain,COUNT(ag.aid) AS project_count
        FROM advisor a
        LEFT JOIN advisor_group ag ON a.id = ag.aid
        GROUP BY a.id, a.username;";
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
}
