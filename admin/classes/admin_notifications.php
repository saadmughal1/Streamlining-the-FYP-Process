<?php

include_once "db.php";

class Admin_notifications
{

    private $id, $aid, $adm_id, $gid, $msg, $status, $date, $isread;
    public $connection;

    public function __construct($connection = null, $id = null, $msg = null, $aid = null, $adm_id = null, $status = null, $isread = null, $gid = null)
    {
        $this->id = $id;
        $this->aid = $aid;
        $this->gid = $gid;
        $this->adm_id = $adm_id;
        $this->msg = $msg;
        $this->status = $status;
        $this->isread = $isread;
        $this->date = date("Y-m-d H:i:s");
        $this->connection = $connection;
    }

    public function sendNotification()
    {
        $sql = "INSERT INTO `admin_notifications`(`msg`, `aid`, `adm_id`, `status`, `date`, `isread`, `gid`) VALUES ('$this->msg', $this->aid, $this->adm_id, $this->status, '$this->date', $this->isread, $this->gid);";

        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Insert Query Failed: " . $this->connection->error);
    }

    public function displayNotification()
    {
        $sql = "SELECT a.username,an.* FROM `admin_notifications` an join `advisor` a on an.aid = a.id WHERE an.`status`= 0 AND an.`isread` = 0;";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }

    public function readNotification()
    {
        $sql = "UPDATE `admin_notifications` SET `isread`= 1 WHERE `id`= $this->id";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Update Query Failed: " . $this->connection->error);
    }

}
