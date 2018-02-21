<?php
require("Repository.php");
class UserRepository extends Repository
{
    function isValidUser()
    {
        
    }
    function doesUserExist()
    {

    }
    function getUserInfo()
    {
        $sql = "SELECT username, password, FROM users";
        $this->conn->query();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            }
        } else {
            echo "0 results";
        }
        return $user;
    }
}
?>