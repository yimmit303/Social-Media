<html>

<head></head>

<body>

<?php

    require_once(realpath(dirname(__FILE__) . '/../Models/User.php'));
    require_once("../Repository/UserRepository.php");

    $repo = new UserRepository;

    $name = $_GET['id'];
    $results = $repo->searchUser($name);

    if ($results != 0){
        foreach($results as $result){
            echo "Name:".$result->UserName;
            echo "<br />";
        }
    } else {
        echo "No Results for".$name;
    }

?>

</body>

</html>