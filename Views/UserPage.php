<?php //INITIAL PHP SCRIPT
session_start();

require_once("../Models/Post.php");
require_once("../Models/User.php");
require_once("../Repository/UserRepository.php");
require_once("../Repository/PostRepository.php");

$Last_Page = $_SESSION['Last_Page'];

$userRepo = new UserRepository();
$postRepo = new PostRepository();

if($Last_Page == "Login"){
    $username = $_REQUEST['email'];
    $id = $userRepo->getIDByUser($username);
    $_SESSION['id'] = $id;
}elseif($Last_Page == "NewUser"){
    $newbie = new User();
    $newbie->Username       = $_REQUEST['email'];
    $newbie->Password       = $_REQUEST['password'];
    $newbie->FirstName      = $_REQUEST['firstname'];
    $newbie->LastName       = $_REQUEST['lastname'];
    $newbie->DateOfBirth    = $_REQUEST['dob'];
    $newbie->Bio            = $_REQUEST['bio'];
    $newbie->Interest       = $_REQUEST['interests'];
    $newbie->Job            = $_REQUEST['job'];
    $newbie->Employer       = $_REQUEST['emp'];
    //$userRepo->addUser($newbie);
    $userRepo->addUserBaseInfo($_REQUEST['email'], $_REQUEST['password'], $_REQUEST['firstname'], $_REQUEST['lastname']);
    $id = $userRepo->getIDByUser($newbie->Username);
    $_SESSION['id'] = $id;
}elseif($Last_Page == "EditUser"){
    $id = $_SESSION['id'];
}else{
    $id = $_SESSION['id'];
}

if(isset($_POST['New_Post'])){
    $postRepo->addPost($id, $_POST['New_Post']);
}

$ViewedUser = $userRepo->getInfoByID($id);
$loggedin = $ViewedUser->UserId;

$friends = $userRepo->getFriendArray($id);
$posts = array();
$friendids = array();
if(!empty($friends)){
    foreach($friends as $friend){
        array_push($friendids, $friend->UserId);
    }
}
array_push($friendids, $ViewedUser->UserId);
$posts = array_reverse($postRepo->getNewsFeed($friendids));

$LIKE = "<span class='glyphicon glyphicon-thumbs-up'></span>";
$DISLIKE = "<span class='glyphicon glyphicon-thumbs-down'></span>";

if(isset($_POST['rate'])){
    if($_POST['rate'] == 'like'){$postRepo->like($loggedin, $_POST['Post_Rated']);}
    if($_POST['rate'] == 'dislike'){$postRepo->dislike($loggedin, $_POST['Post_Rated']);}
}

$_SESSION['Last_Page'] = 'User';
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
function redirect_edit(){
    window.location.href = 'EditUser.php';
}
function redirect_friends(){
    window.location.href = 'ManageFriends.php';
}
function logout(){
    window.location.href = 'Login.php';
}
</script>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Generic Social Media</a>
    </div>
    <ul class="nav navbar-nav">
      <li class='active'><a href="#">User Page</a></li>
      <li onclick='redirect_edit()'><a href="#">Edit Yourself</a></li>
      <li onclick='redirect_friends()'><a href="#">Friends</a></li>

    </ul>
    <form class="navbar-form navbar-left" action="SearchResults.php">
        <div class = "input-group">
            <input type="text" class="form-control" placeholder="Search For Friends" name="search">
        </div>
    </form>
    <ul class="nav navbar-nav navbar-right">
      <li onclick='logout();'><a href="#"><span class="glyphicon glyphicon-minus-sign"></span> Logout</a></li>
    </ul>
  </div>
</nav>
  
<div class="container" style="margin-top:75px">
  <div class = "row">
    <div class="col-sm-4">
        <?php
            echo('<div class="well">');
                echo("<h2>Your Info</h2><br>");
                echo("<h4>First Name:  ".$ViewedUser->FirstName."</h4>");
                echo("<h4>Last Name:  ".$ViewedUser->LastName."</h4>");
                echo("<h4>Date of Birth:  ".$ViewedUser->DateOfBirth."</h4>");
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
        <div class = "well">
            <form action = "UserPage.php" method = "post">
                <input type="hidden" name = "Last_Page"  value="User"></input>
                <textarea class="form-control" rows="3" name="New_Post" placeholder="What's on your mind ma dude?"></textarea>
                <button type="submit" class="btn btn-primary btn-sm">Post</button>
            </form>
        </div>
        <?php
            foreach($posts as $current){
                echo("<div class='well'>");
                    echo("Posted By ".$userRepo->getUsernameById($current->UserId)." on ".$current->PostDate);
                    echo("<div class='well'>");
                    echo($current->Content);
                    echo("</div>");
                    echo("<form class='form-inline' action='UserPage.php' method='post'>");
                        echo("<input type='hidden' class='form-control' name='Post_Rated' value=".$current->PostId.">");
                        echo("<div class='btn-group btn-group-sm'>");
                            echo("<button type='submit' class='btn btn-primary' name='rate' value='like'>[".$LIKE."]</button>");
                            echo("<button type='button' class='btn btn-disabled'>".$current->Rating."</button>");
                            echo("<button type='submit' class='btn btn-danger' name='rate' value='dislike'>[".$DISLIKE."]</button>");
                        echo("</div>");
                    echo('</form>');
                echo("</div>");
            }
        ?>
    </div>
  </div>
</div>

</body>

</html>