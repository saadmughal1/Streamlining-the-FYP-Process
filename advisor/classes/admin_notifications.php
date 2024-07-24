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
        $this->adm_id = $adm_id;
        $this->msg = $msg;
        $this->status = $status;
        $this->isread = $isread;
        $this->gid = $gid;
        $this->date = date("Y-m-d H:i:s");
        $this->connection = $connection;
    }

    public function sendNotification()
    {
        $sql = "INSERT INTO `admin_notifications`(`msg`, `aid`, `adm_id`, `status`,`date`,`isread`,`gid`) VALUES ('$this->msg','$this->aid','$this->adm_id','$this->status','$this->date','$this->isread','$this->gid');";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Insert Query Failed: " . $this->connection->error);
    }

    public function displayNotification()
    {
        $sql = "SELECT * FROM `admin_notifications` WHERE `aid` = $this->aid AND `status`= 1 AND `isread` = 0;";
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


    public function readChangePasswordNotif($aid)
    {
        $sql = "UPDATE `admin_notifications` SET `isread`= 1 WHERE `aid`= $aid AND `gid`= -1";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Update Query Failed: " . $this->connection->error);
    }
}
