<?php

include_once "db.php";

class Notifications
{

    private $id, $aid, $gid, $msg, $status, $date, $isread;
    public $connection;

    public function __construct($connection = null, $id = null, $msg = null, $aid = null, $gid = null, $status = null, $isread = null)
    {
        $this->id = $id;
        $this->aid = $aid;
        $this->gid = $gid;
        $this->msg = $msg;
        $this->status = $status;
        $this->isread = $isread;
        $this->date = date("Y-m-d H:i:s");
        $this->connection = $connection;
    }

    public function sendNotification()
    {
        $sql = "INSERT INTO `notifications`(`msg`, `aid`, `gid`, `status`,`date`,`isread`) VALUES ('$this->msg','$this->aid','$this->gid','$this->status','$this->date','$this->isread');";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Insert Query Failed: " . $this->connection->error);
    }

    public function displayNotification()
    {
        $sql = "SELECT a.username, n.* FROM `notifications` n join `advisor` a on a.id = n.aid WHERE n.`gid` = $this->gid AND n.`status`= 1 AND n.`isread` = 0;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function readNotification()
    {
        $sql = "UPDATE `notifications` SET `isread`= 1 WHERE `id`= $this->id";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Update Query Failed: " . $this->connection->error);
    }
}
