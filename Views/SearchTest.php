<html>

<head></head>

<body>

<?php

    require("UserRepository.php");
    require_once(realpath(dirname(__FILE__) . '/../Models/User.php'));

    $repo = new UserRepository;

    $name = $_GET['id'];
    $results = $repo->searchUser($name);

    if (sizeof($results) > 0){
        foreach(results){
            echo "Name:".$results->FirstName;
            echo "<br />"
        }
    } else {
        echo "WE AIN'T FOUND SHIT";
    }

?>

</body>

</html>