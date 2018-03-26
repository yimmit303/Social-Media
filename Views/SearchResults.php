<?php
session_start();

require_once("../Models/User.php");
require_once("../Repository/UserRepository.php");

$repo = new UserRepository;

$search_term = $_GET['search'];

$results = $repo->searchUser($search_term);

?>



<html lang = "en">
<head>
  <title>Search Results</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<script>
function redirect_Friend(userid){
    var baseurl = 'FriendPage.php?friend_id='
    window.location.href = baseurl.concat(userid);
}
</script>

<body>


<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Generic Social Media</a>
    </div>
    <ul class="nav navbar-nav">

        <form class="navbar-form navbar-left" action = "UserPage.php" method = "post">
        <input type="hidden" name = "Last_Page"  value="User"></input>
        <button type="submit" class="btn navbar-btn">Your Page</button>
        </form>

        <form class="navbar-form navbar-left" action = "EditUser.php" method = "post">
        <input type="hidden" name = "Last_Page"  value="User"></input>
        <button type="submit" class="btn navbar-btn">Edit Yourself</button>
        </form>

        <form class="navbar-form navbar-left" action = "EditUser.php" method = "post">
        <input type="hidden" name = "Last_Page"  value="User"></input>
        <button class="btn navbar-btn">Manage Friends</button>
        </form>
    
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
            <div class="col-sm-8">
                <?php
                    if($results!=0){
                    foreach($results as $result){
                        echo("<button type='button' class='btn btn-default btn-block' onclick='redirect_Friend(".$result->UserId.")'>");
                            echo("<div class='well'>");
                                echo("<h1>".$result->FirstName." ".$result->LastName."</h1>");
                                echo($result->UserName);
                            echo("</div>");
                        echo("</button>");
                    }}else{
                        echo("<div class='well'>");
                            echo("<h1>Sorry, We couldn't find anyone with that Name ):</h1>");
                        echo("<div>");
                    }
                ?>
            </div>
        </div>
    </div>

</body>

</html>