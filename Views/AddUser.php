<?php
    require_once("../Repository/UserRepository.php");
    $userRepo = new UserRepository();
    #$didSucceed = $userRepo->addUserBaseInfo("user","pass", "foo", "bar");
    #$didSucceed = $userRepo->addUserBaseInfo("mike", "wazoski", "your", "paperwork");
    #echo "added user : ".($didSucceed ? "TRUE" : "FALSE");
    $userRepo->searchUser("y");
    $user = $userRepo->getInfoByID(1);
    echo $user->Username;

?>