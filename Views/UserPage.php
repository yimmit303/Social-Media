<?php
require_once("../Repository/UserRepository.php");
$userRepo = new UserRepository();
$user = $userRepo->getInfoByID(2);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
</head>
<body>
    <?php
        echo "Username: ".$user->Username."<br />";
        echo "Password: ".$user->Password."<br />";
        echo "Does the user foo exist? ".($userRepo->doesUserExist("foo") ? "TRUE" : "FALSE")."<br />";
        echo "Would the username user be valid? ".($userRepo->isValidUser("user") ? "TRUE" : "FALSE")."<br />";
        echo "Would the username raboof be valid? ".($userRepo->isValidUser("raboof") ? "TRUE" : "FALSE")."<br />";
        echo "What is the id of user foo? ".$userRepo->getIDByUser("foo")."<br />";
        $userRepo->addUserBaseInfo("user","pass", "foo", "bar");
    ?>
</body>
</html>