<?php
require("Repository.php");
require_once(realpath(dirname(__FILE__) . '/../Models/User.php'));
class UserRepository extends Repository
{
    function isValidUser($username_to_check)
    {
        $sql = "SELECT username FROM users";
        $this->conn->query($sql);
        $result = $this->conn->query($sql);
        $isValid = TRUE;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row["username"] == $username_to_check){
                    $isValid = FALSE;
                }
            }
        } 
        else {
            echo "0 results";
        }
        return $isValid;
    }
    function doesUserExist($username_to_check)
    {
        $sql = "SELECT username FROM users";
        $this->conn->query($sql);
        $result = $this->conn->query($sql);
        $doesExist = FALSE;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row["username"] == $username_to_check){
                    $doesExist = TRUE;
                }
            }
        } 
        else {
            echo "0 results";
        }
        return $doesExist;
    }
    function getInfoByID($id)
    {
        $sql = "SELECT userId, username, password, firstName, lastName, dateOfBirth, bio, interest, job, employeer, isSuspended, isPublic, profilePicture FROM users";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $user = new User();
            while($row = $result->fetch_assoc()) {
                if($row["userId"] == $id)
                {
                    $user->UserId = $row["userId"];
                    $user->Username = $row["username"];
                    $user->Password = $row["password"];
                    $user->FirstName = $row["firstName"];
                    $user->LastName = $row["lastName"];
                    $user->DateOfBirth = $row["dateOfBirth"];
                    $user->Bio = $row["bio"];
                    $user->Interest = $row["interest"];
                    $user->Job = $row["job"];
                    $user->Employer = $row["employeer"];
                    $user->isSuspended = $row["isSuspended"];
                    $user->isPublic = $row["isPublic"];
                    $user->ProfilePicture = $row["profilePicture"];
                }
            }
            return $user;
        } else {
            echo "0 results";
        }

    }
    function getIDByUser($username)
    {
        $sql = "SELECT userId, username FROM users";
        $this->conn->query($sql);
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row["username"] == $username){
                    return $row["userId"];
                }
            }
        } 
        else {
            echo "0 results";
        }
    }
}
?>