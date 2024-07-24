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
    public function addAgenda()
    {
        $sql = "INSERT INTO `agenda`(`mid`, `gid`, `sid`, `agenda`) VALUES ($this->mid,$this->gid,$this->sid,'$this->agenda');";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Insert Query Failed: " . $this->connection->error);
    }

    public function isAgendaFilled()
    {
        $sql = "SELECT * FROM `agenda` WHERE `mid` = $this->mid AND `gid` = $this->gid AND `sid` = $this->sid;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }
}
