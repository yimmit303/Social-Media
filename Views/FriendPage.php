<?php //INITIAL PHP SCRIPT
session_start();
if(isset($_GET['friend_id']))
    {$friend_id = $_GET['friend_id'];}
    else{$friend_id = $_SESSION['friend_id'];}

$loggedin= $_SESSION['id'] ;
$_SESSION['friend_id'] = $friend_id;

require_once("../Models/Post.php");
require_once("../Models/User.php");
require_once("../Repository/UserRepository.php");
require_once("../Repository/PostRepository.php");

$LIKE = "<span class='glyphicon glyphicon-thumbs-up'></span>";
$DISLIKE = "<span class='glyphicon glyphicon-thumbs-down'></span>";

$userRepo = new UserRepository();
$postRepo = new PostRepository();
$ViewedUser = $userRepo->getInfoByID($friend_id);

if(isset($_POST['fid'])){$userRepo->addFriend($loggedin, $friend_id);}

$posts = $postRepo->getUserPosts($friend_id);

$friend_status = $userRepo->isFriend($_SESSION['id'], $friend_id);

$friends = $userRepo->getFriendArray($friend_id);

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
                if(!$friend_status){
                    echo("<form action='FriendPage.php' method='post'>");
                    echo('<input type="hidden" name = "fid"  value="'.$friend_id.'"></input>');
                    echo("<button type = submit class='btn btn-primary btn-sm'>Add Friend</button>");
                    echo("</form>");
                }
            echo('</div>');
        ?>
        <?php
            echo("<div class = 'well'>");
            echo("<h2>Friends</h2>");
            foreach($friends as $friend){
                echo("<form action='FriendPage.php' method='get'>");
                echo("<input type='hidden' class='form-control' name='friend_id' value='".$friend->UserId."'>");
                echo("<button type='submit' class='btn btn-block'>".$friend->Username."</button>");
                echo('</form>');
            }
            echo('</div>');
        ?>
    </div>
    <div class="col-sm-8">
        <?php
            foreach($posts as $current){
                echo("<div class='well'>");
                    echo("Posted By ".$current->UserId." on ".$current->PostDate);
                    echo("<div class='well'>");
                        echo($current->Content);
                    echo("</div>");
                    echo("<form action='UserPage.php' method='post'>");
                    echo("<input type='hidden' class='form-control' name='Like' value=".$current->PostId.">");
                    echo("<button type='submit' class='btn btn-primary'>".$LIKE."</button>");
                    echo("<button class='btn disabled'>".$current->Rating."</button>");
                    echo("<button type='button' class='btn btn-danger'>".$DISLIKE."</button>");
                    echo('</form>');
                echo("</div>");
            }
        ?>
    </div>
  </div>
</div>

</body>

</html>