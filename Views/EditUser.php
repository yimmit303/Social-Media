<?php
session_start();

require_once("../Models/User.php");
require_once("../Repository/UserRepository.php");

$id = $_SESSION['id'];
if($id == null){$id=1;}

$userRepo = new UserRepository();
$CurrentUser = $userRepo->getInfoByID($id);

$_SESSION['Last_Page'] = 'EditUser';
?>

<html lang="en">
<head>
  <title>Edit User Page</title>
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
</script>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Generic Social Media</a>
    </div>
    <ul class="nav navbar-nav">
      <li onclick='redirect_user()'><a href="#">User Page</a></li>
      <li class='active'><a href="#">Edit Yourself</a></li>
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
  <div class="col-sm-6">
    <form action"EditUser.php" method="post">
      <input type="hidden" class="form-control" name="Last_Page"  value="EditUser">
      <label for="name">First Name:</label>
      <input type="text" class="form-control" value=<?php echo('"'.$CurrentUser->FirstName.'"')?> id="firstname">
      <label for="name">Last Name:</label>
      <input type="text" class="form-control" value=<?php echo('"'.$CurrentUser->LastName.'"')?> id="lastname">
      <label for="dob">Date of Birth:</label>
      <input type="text" class="form-control" value=<?php echo('"'.$CurrentUser->DateOfBirth.'"')?> id="dob">
      <label for="interests">Interests:</label>
      <input type="text" class="form-control" value=<?php echo('"'.$CurrentUser->Interest.'"')?> id="interests">
      <label for="job">Job:</label>
      <input type="text" class="form-control" value=<?php echo('"'.$CurrentUser->Job.'"')?> id="job">
      <label for="emp">Employer:</label>
      <input type="text" class="form-control"value=<?php echo('"'.$CurrentUser->Employer.'"')?> id="emp">
      <label for="pfp">Profile Picture:</label>
      <input type="text" class="form-control" value=<?php echo('"'.$CurrentUser->ProfilePicture.'"')?> id="pfp">
      <label for="bio">Bio:</label>
      <textarea class="form-control" rows="5" id="bio"></textarea>
      <div class="well">
      <label for="susp">Suspension Status:</label>
      <label class="radio-inline"><input type="radio" name="susp" checked>Active</label>
      <label class="radio-inline"><input type="radio" name="susp">Suspended</label>
      </div>
      <div class = "well">
      <label for="priv">Privacy Status:</label>
      <label class="radio-inline"><input type="radio" name="priv" checked>Public</label>
      <label class="radio-inline"><input type="radio" name="priv">Private</label>
      </div>
      <button type="submit" class="btn btn-primary btn-lg">Submit</button>
    </form>
  </div>
</div>

</body>
</html>
