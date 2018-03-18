<?php
require("Repository.php");
require_once(realpath(dirname(__FILE__) . '/../Models/User.php'));
class UserRepository extends Repository
{
    function isValidUser($username_to_check)
    {
        $sql = "SELECT username FROM users";
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
        $sql = "SELECT userId, username, password, firstName, lastName, dateOfBirth, bio, interest, job, employeer, isSuspended, isPublic, profilePicture FROM users WHERE userId = '".$id."'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $user = new User();
            while($row = $result->fetch_assoc()) {
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
            return $user;
        } else {
            echo "0 results";
        }

    }
    function getIDByUser($username)
    {
        $sql = "SELECT userId, username FROM users";
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
    function addUser($user)
    {
        $sql = "INSERT INTO user (username, password, firstName, lastName, dateOfBirth, bio, interest, job, employeer, isSuspended, isPublic, profilePicture) 
        VALUES (".$user->Username.", ".$user->Password.", ".$user->FirstName.", ".$user->LastName.", ".$user->DateOfBirth.", ".$user->Bio.", ".$user->Interest.", ".$user->Job.", ".$user->Employer.", ".$user->isSuspended.", ".$user->isPrivate.", ".$user->ProfilePicture.")";
    }
    function addUserBaseInfo($username, $password, $firstname, $lastname)
    {
        $sql = "INSERT INTO users (username, password, firstName, lastName) VALUES ('".$username."', '".$password."', '".$firstname."', '".$lastname."')";
        if (mysqli_query($this->conn, $sql)) {
            return TRUE;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
    }
    function searchUser($name)
    {
        $nameArray = array();
        $name = chop($name);
        if(strpos($name," "))
        {
            $inputNameArray = array();
            foreach(explode(" ", $name) as $nme)
            {
                $inputNameArray[] = $nme;
            }
            $sql = "SELECT firstName, lastName, username FROM users WHERE firstName REGEXP '".$inputNameArray[0]."' AND lastName REGEXP '".$inputNameArray[1]."' AND isPublic = '1'";
            $result = $this->conn->query($sql);
            
            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $nameArray[] = $row["firstName"];
                    $nameArray[] = $row["lastName"];
                    $nameArray[] = $row["username"];
                }
            } 
            else {
                echo "No results found for ".$inputNameArray[0]." ".$inputNameArray[1];
            }
            return $nameArray;
        }
        else
        {
            $sql = "SELECT firstName, lastName, username FROM users WHERE firstName REGEXP '".$name."' AND isPublic = '1'";
            $result = $this->conn->query($sql);
            
            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $nameArray[] = $row["firstName"];
                    $nameArray[] = $row["lastName"];
                    $nameArray[] = $row["username"];
                }
            } 
            else 
            {
                echo "No results found for ".$name;
            }
            return $nameArray;
        }
    }
}
?>