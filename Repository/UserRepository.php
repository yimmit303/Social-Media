<?php
require_once("Repository.php");
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
    function getInfoByID($userId, $getFriendsArray = FALSE)
    {
        $sql = "SELECT userId, username, password, firstName, lastName, dateOfBirth, bio, interest, job, employeer, isSuspended, isPublic, profilePicture FROM users WHERE userId = '".$userId."'";
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
                if($getFriendsArray)
                {
                    $user->friendArray = $this->getFriendArray($row["userId"]);
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
    function getUsernameById($userId)
    {
        $sql = "SELECT userId, username FROM users WHERE userId = '".$userId."'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row["username"];
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
        if($name == ""){return 0;}

        $nameArray = array();
        $name = chop($name);
        if(strpos($name," "))
        {
            $inputNameArray = array();
            foreach(explode(" ", $name) as $nme)
            {
                $inputNameArray[] = $nme;
            }
            $sql = "SELECT userId, username, firstName, lastName, dateOfBirth, bio, interest, job, employeer, isSuspended, isPublic, profilePicture FROM users WHERE firstName REGEXP '".$inputNameArray[0]."' AND lastName REGEXP '".$inputNameArray[1]."' AND isPublic = '1'";
            $result = $this->conn->query($sql);
            
            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $p1 = new User();
                    $p1->UserId =  $row["userId"];
                    $p1->UserName =  $row["username"];
                    $p1->FirstName =  $row["firstName"];
                    $p1->LastName =  $row["lastName"];
                    $p1->DateOfBirth = $row['dateOfBirth'];
                    $p1->Bio = $row['bio'];
                    $p1->Interest = $row['interest'];
                    $p1->Job = $row['job'];
                    $p1->Employer = $row['employeer'];

                    if($nameArray == null){$nameArray = array($p1);}
                    else{$nameArray[] = $p1;}
                }
            } 
            else {
                return 0;
            }
            return $nameArray;
        }
        else
        {
            $sql = "SELECT userId, username, firstName, lastName, dateOfBirth, bio, interest, job, employeer, isSuspended, isPublic, profilePicture FROM users WHERE firstName REGEXP '".$name."' AND isPublic = '1'";
            $result = $this->conn->query($sql);
            
            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $p1 = new User();
                    $p1->UserId =  $row["userId"];
                    $p1->UserName =  $row["username"];
                    $p1->FirstName =  $row["firstName"];
                    $p1->LastName =  $row["lastName"];
                    $p1->DateOfBirth = $row['dateOfBirth'];
                    $p1->Bio = $row['bio'];
                    $p1->Interest = $row['interest'];
                    $p1->Job = $row['job'];
                    $p1->Employer = $row['employeer'];

                    if($nameArray == null){$nameArray = array($p1);}
                    else{$nameArray[] = $p1;}
                }
            } 
            else 
            {
                return 0;
            }
            return $nameArray;
        }
    }
    function updateUser($userInfoArray, $userId)
    {
        #updates Fname, Lname, DoB, interests, job, employer, profile pic, bio, suspended, private
        $wasSuccessful = FALSE;
        $sql = "UPDATE users SET firstName = '".$userInfoArray[0]."', lastName = '".$userInfoArray[1]."', ";
        $sql .= "dateOfBirth = '".$userInfoArray[2]."', interest = '".$userInfoArray[3]."', job = '".$userInfoArray[4]."', ";
        $sql .= "employeer = '".$userInfoArray[5]."', profilePicture = '".$userInfoArray[6]."', bio = '".$userInfoArray[7]."', ";
        $sql .= "isSuspended = '".$userInfoArray[8]."', isPublic = '".$userInfoArray[9]."' WHERE userId = ".$userId;
        if ($this->conn->query($sql) === TRUE) {
            $wasSuccessful = TRUE;
        } else {
            echo "Error updating record: " . $this->conn->error;
        }
        return $wasSuccessful;
    }
    function updatePassword($newPass, $userId)
    {
        $wasSuccessful = FALSE;
        $sql = "UPDATE users SET password = '".$newPass."' WHERE userId = ".$userId;
        if ($this->conn->query($sql) === TRUE) {
            $wasSuccessful = TRUE;
        } else {
            echo "Error updating record: " . $conn->error;
        }
        return $wasSuccessful;
    }
    function isFriend($userId, $friendId)
    {
        $isFriend = FALSE;
        $sql = "SELECT userId, friendId FROM friends WHERE userId = '".$userId."' AND friendId = '".$friendId."'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) 
        {
            $isFriend = TRUE;
        } 
        else 
        {
            #echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
        return $isFriend;
    }
    function addFriend($userId, $friendId)
    {
        if($this->isFriend($userId, $friendId))
        {
            return TRUE;
        }
        $sql = "INSERT INTO friends (userId, friendId) VALUES ('".$userId."', '".$friendId."')";
        if (mysqli_query($this->conn, $sql)) {
            return TRUE;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
    }
    function removeFriend($userId, $friendId)
    {
        $wasSuccessful = FALSE;
        if($this->isFriend($userId, $friendId))
        {
            $sql = "DELETE FROM friends WHERE userId = '".$userId."' AND friendId = '".$friendId."'";
            if ($this->conn->query($sql) === TRUE) {
                $wasSuccessful = TRUE;
            } else {
                echo "Error removing record: " . $conn->error;
            }
        }  
        return $wasSuccessful;
    }
    function getFriendArray($userId)
    {
        $friendArray = array();
        $sql = "SELECT friendId FROM friends WHERE userId = '".$userId."'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc()) 
            {
                $friend = $this->getInfoByID($row["friendId"], FALSE);
                $friendArray[] = $friend;
            }
        } 
        else 
        {
            //echo "Error getting friends: " . $conn->error;
        }
        return $friendArray;
    }
    function getFriendIdArray($userId)
    {
        $friendIdArray = array();
        $user = $this->getInfoByID($userId, TRUE);
        $friendIdArray[] = $user->UserId;
        foreach ($user->friendArray as $friend) 
        {
            $friendIdArray[] = $friend->UserId;
        }
        return $friendIdArray;
    }
}
?>