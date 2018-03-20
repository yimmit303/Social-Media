<?php
class Repository
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "users";
    public $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }

    function close()
    {
        $this->conn->close();
    }
}
?>