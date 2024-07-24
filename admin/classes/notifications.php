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

    
}
