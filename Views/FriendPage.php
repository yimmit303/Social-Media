<?php //INITIAL PHP SCRIPT

$id = $_GET['id'];

require_once("../Models/Post.php");
require_once("../Models/User.php");
require_once("../Repository/UserRepository.php");

//Creating a bunch of dummy posts and a post array
$p1 = new post();
$p2 = new post();
$p3 = new post();
$p4 = new post();
$posts = array($p1, $p2, $p3, $p4);

$LIKE = "<span class='glyphicon glyphicon-thumbs-up'></span>";
$DISLIKE = "<span class='glyphicon glyphicon-thumbs-down'></span>";

//Filling In Random Garbage information for posts
foreach($posts as $current){
    $current->Content   = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pulvinar in enim a commodo. Aliquam a interdum diam. Duis pretium semper leo, iaculis eleifend nibh varius sit amet. In hac habitasse platea dictumst. Vestibulum nec tincidunt velit, eget molestie elit. Integer quis gravida velit. Fusce pretium tortor ut felis faucibus suscipit. Morbi id luctus enim, vitae laoreet libero. In a dapibus lacus.";
    $current->PostDate  = "NOPE";
    $current->Likes     = "1";
    $current->Dislikes = "2";
}

$userRepo = new UserRepository();
$ViewedUser = $userRepo->getInfoByID($id);

?>



<html lang = "en">
<head>
  <title>Friend Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Generic Social Media</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#"><?php echo($ViewedUser->FirstName);?>'s Page</a></li>
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