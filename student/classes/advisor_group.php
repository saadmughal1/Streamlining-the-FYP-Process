<?php

include_once "db.php";

class Advisor_group
{

    private $id, $aid, $gid;
    public $connection;

    public function __construct($connection = null, $id = null, $aid = null, $gid = null)
    {
        $this->id = $id;
        $this->aid = $aid;
        $this->gid = $gid;
        $this->connection = $connection;
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

    public function isGroupApproved()
    {
        $sql = "SELECT * FROM `advisor_group` WHERE `gid` = $this->gid AND `approved` = 1;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }
}
