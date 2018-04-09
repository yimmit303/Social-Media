<?php


require_once("../Models/User.php");
require_once("../Repository/UserRepository.php");

$userRepo = new UserRepository();

if($_POST['email'] == ''){
    echo('You need to enter your username');
    return;
}else{$username = $_POST['email'];}

if($_POST['password'] == ''){
    echo('You need to enter your password');
    return;
}else{$password = $_POST['password'];}

if(!$userRepo->doesUserExist($username)){
    echo("We don't have anyone by that name here :(");
    return;
}else{
    $usid = $userRepo->getIDByUser($username);
    $user = $userRepo->getInfoByID($usid);
}

if($password != $user->Password){
    echo("Looks like your password was incorrect.");
    return;
}else{echo('true');return;}

?>