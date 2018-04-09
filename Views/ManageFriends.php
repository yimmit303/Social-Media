<?php
session_start();

require_once("../Models/User.php");
require_once("../Repository/UserRepository.php");

$Last_Page = $_SESSION['Last_Page'];

$userRepo = new UserRepository();
$vid = $_SESSION['id'];
$Viewed_User = $userRepo->getInfoByID($vid);

if(isset($_POST['removed_friend'])){
  $userRepo->removeFriend($vid, $_POST['removed_friend']);
}

$Friends = $userRepo->getFriendArray($vid);

$_SESSION['Last_Page'] = 'ManageFriends';


?>



<html lang="en">
<head>
  <title>Your Friends</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<script type="text/javascript">
function redirect_user(){
    window.location.href = 'UserPage.php';
}
function redirect_edit(){
    window.location.href = 'EditUser.php';
}
function redirect_friends(){
    window.location.href = 'ManageFriends.php';
}
function remove_Friend(userid){
  fid = "fr";
  form = document.getElemtneById(fid.concat(string(userid)));
  form.action='ManageFriends.php';
}
function visit_Friend(userid){
  fid = "fr";
  form = document.getElemtneById(fid.concat(string(userid)));
  form.action='FriendPage.php';
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

        <li onclick='redirect_user()'><a href="#">User Page</a></li>
        <li onclick='redirect_edit()'><a href="#">Edit Yourself</a></li>
        <li class='active'><a href="#">Friends</a></li>
    
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
  <div class="col-sm-6">
    <?php
      foreach($Friends as $friend){
        echo("<div class='well'>");
          echo($friend->Username);
          echo("<div class='well'>");
          if(strlen($friend->Bio) > 150){echo(substr($friend->Bio, 0, 147)."...");}
          else{echo($friend->Bio);}
          echo("</div>");
          echo("<form id='fr".$friend->UserId."' action='' method='post'>");
            echo("<button type='submit' name='friend_id' class='btn btn-primary' formaction='FriendPage.php' value='$friend->UserId'>Visit Friend</button>");
            echo("<button type='submit' name='removed_friend' class='btn btn-danger' formaction='ManageFriends.php' value='$friend->UserId'>Remove Friend</button>");
          echo("</form>");
        echo("</div>");
      }
    ?>
  </div>
</div>

</body>
</html>
