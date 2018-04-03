<?php
    require_once("../Repository/UserRepository.php");
    require_once("../Repository/PostRepository.php");
    $userRepo = new UserRepository();
    $postRepo = new PostRepository();
    #$didSucceed = $userRepo->addUserBaseInfo("user","pass", "foo", "bar");
    #$didSucceed = $userRepo->addUserBaseInfo("mike", "wazoski", "your", "paperwork");
    #echo "added user : ".($didSucceed ? "TRUE" : "FALSE");
    
    #updates Fname, Lname, DoB, interests, job, employer, profile pic, bio, suspended, private
    $arr1 = $userRepo->getFriendIdArray(1);

    foreach($arr1 as $id)
    {
        echo $id;
        echo "<br>";
    }

    $arr2 = $postRepo->getNewsfeed($arr1);
    echo $arr2[0]->Content;

?>