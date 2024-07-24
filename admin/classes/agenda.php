<?php

include_once "db.php";

class Agenda
{

    private $id, $mid, $gid, $sid, $agenda;
    public $connection;

    public function __construct($connection = null, $id = null, $mid = null, $gid = null, $sid = null, $agenda = null)
    {
        $this->id = $id;
        $this->mid = $mid;
        $this->gid = $gid;
        $this->sid = $sid;
        $this->agenda = $agenda;
        $this->connection = $connection;
    }

    public function getAgendaBySidGidMid($mid,$sid,$gid)
    {
        $sql = "SELECT * FROM `agenda` WHERE `mid` = $mid AND `gid` = $gid AND `sid` = $sid;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }
}
