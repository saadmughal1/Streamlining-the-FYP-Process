<?php

include_once "db.php";

class Department
{

    private $id, $title;
    public $connection;

    public function __construct($connection = null, $id = null, $title = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->connection = $connection;
    }

    public function addDept()
    {
        $sql = "INSERT INTO `department`(`name`) VALUES ('$this->title')";;
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }


    public function display()
    {
        $sql = "SELECT * FROM `department`";
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        die("Select Query Failed: " . $this->connection->error);
    }
}
