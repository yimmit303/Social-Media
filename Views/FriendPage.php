<?php //INITIAL PHP SCRIPT
session_start();
$friend_id = $_GET['friend_id'];

require_once("../Models/Post.php");
require_once("../Models/User.php");
require_once("../Repository/UserRepository.php");
require_once("../Repository/PostRepository.php");

$LIKE = "<span class='glyphicon glyphicon-thumbs-up'></span>";
$DISLIKE = "<span class='glyphicon glyphicon-thumbs-down'></span>";

$userRepo = new UserRepository();
$postRepo = new PostRepository();
$ViewedUser = $userRepo->getInfoByID($friend_id);

$posts = $postRepo->getUserPosts($friend_id);

?>



<html lang = "en">
<head>
  <title><?php echo($ViewedUser->Username);?>'s Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<script>
function redirect_user(){
    window.location.href = 'UserPage.php';
}
function redirect_edit(){
    window.location.href = 'EditUser.php';
}
</script>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Generic Social Media</a>
    </div>
    <ul class="nav navbar-nav">

        <li onclick='redirect_user()'><a href="#">User Page</a></li>
        <li onclick='redirect_edit()'><a href="#">Edit Yourself</a></li>
        <li><a href="#">Manage Friends</a></li>

    </ul>
    <form class="navbar-form navbar-left" action="SearchResults.php">
        <div class = "input-group">
            <input type="text" class="form-control" placeholder="Search For Friends" name="search">
        </div>
    </form>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-minus-sign"></span> Logout</a></li>
    </ul>
  </div>
</nav>
  
<div class="container" style="margin-top:75px">
  <div class = "row">
    <div class="col-sm-4">
        <?php
            echo('<div class="well">');
                echo("<h2>".$ViewedUser->Username."'s Info</h2><br>");
                echo("<h4>First Name:  ".$ViewedUser->FirstName."</h4>");
                echo("<h4>Last Name:  ".$ViewedUser->LastName."</h4>");
                echo("<h4>Date of Birth:  ".$ViewedUser->DateOfBirth."</h4>");
            echo('</div>');
        ?>
    </div>
    <div class="col-sm-8">
        <?php
            foreach($posts as $current){
                echo("<div class='well'>");
                    echo("<div class='well'>");
                        echo($current->Content);
                    echo("</div>");
                    echo("<button type='button' class='btn btn-primary'>".$LIKE."</button>");
                    echo("<button type='button' class='btn btn-danger'>".$DISLIKE."</button>");
                echo("</div>");
            }
        ?>
    </div>
  </div>
</div>

</body>

</html>