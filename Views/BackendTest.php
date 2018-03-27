<?php
    require_once("../Repository/UserRepository.php");
    require_once("../Repository/PostRepository.php");
    $userRepo = new UserRepository();
    $postRepo = new PostRepository();
    #$didSucceed = $userRepo->addUserBaseInfo("user","pass", "foo", "bar");
    #$didSucceed = $userRepo->addUserBaseInfo("mike", "wazoski", "your", "paperwork");
    #echo "added user : ".($didSucceed ? "TRUE" : "FALSE");
    
    #updates Fname, Lname, DoB, interests, job, employer, profile pic, bio, suspended, private
    $array = $postRepo->getUserPosts(1);
    #$postRepo->addPost(1,"We're you're wor'st ene'my");
    $postRepo->editPost(1,"I'm not testing anymore!");
    echo "Post: ".$array[0]->Content;
    echo "<br> Rating: ".$array[0]->Rating;
    echo "<br>";
    echo "Post: ".$array[1]->Content;
    echo "<br> Rating: ".$array[1]->Rating;
    echo "<br>complete";

?>