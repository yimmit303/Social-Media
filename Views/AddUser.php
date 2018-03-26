<?php
    require_once("../Repository/UserRepository.php");
    $userRepo = new UserRepository();
    #$didSucceed = $userRepo->addUserBaseInfo("user","pass", "foo", "bar");
    #$didSucceed = $userRepo->addUserBaseInfo("mike", "wazoski", "your", "paperwork");
    #echo "added user : ".($didSucceed ? "TRUE" : "FALSE");
    
    #updates Fname, Lname, DoB, interests, job, employer, profile pic, bio, suspended, private
    $userRepo->searchUser("y");
    $input = array("Tim", "Steiner", "2011/11/11", "Videogames", "N/A", "N/A", "goodlookin.png", "TODO", "0", "1");
    $success = $userRepo->updateUser($input, 8);
    echo $success;
    echo "<br>complete";

?>