<?php

include_once "db.php";

class Advisor_group
{

    private $id, $aid, $gid, $approved;
    public $connection;

    public function __construct($connection = null, $id = null, $aid = null, $gid = null, $approved = null)
    {
        $this->id = $id;
        $this->aid = $aid;
        $this->gid = $gid;
        $this->approved = $approved;
        $this->connection = $connection;
    }
    
    public function acceptGroup()
    {
        $sql = "INSERT INTO `advisor_group`(`aid`, `gid`) VALUES ($this->aid,$this->gid);";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Insert Query Failed: " . $this->connection->error);
    }

    public function getAdvisorByGroupId()
    {
        $sql = "SELECT * FROM `advisor_group` where `gid` = $this->gid;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }
}
