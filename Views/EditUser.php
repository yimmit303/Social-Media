<?php
session_start();

require_once("../Models/User.php");
require_once("../Repository/UserRepository.php");

$id = $_SESSION['id'];
if($id == null){$id=1;}

$userRepo = new UserRepository();

$edited = isset($_POST['Edited']);

if($edited){
  $new_info = array();
  array_push($new_info, $_POST['firstname']);
  array_push($new_info, $_POST['lastname']);
  array_push($new_info, $_POST['dob']);
  //array_push($new_info, NULL);
  array_push($new_info, $_POST['interests']);
  array_push($new_info, $_POST['job']);
  array_push($new_info, $_POST['emp']);
  array_push($new_info, $_POST['pfp']);
  array_push($new_info, $_POST['bio']);
  if($_POST['susp'] == 'Active'){array_push($new_info, 1);}
  else{array_push($new_info, 0);}
  if($_POST['priv'] == 'Public'){array_push($new_info, 1);}
  else{array_push($new_info, 0);}
  $userRepo->updateUser($new_info, $id);
  $CurrentUser = $userRepo->getInfoByID($id);
}

$CurrentUser = $userRepo->getInfoByID($id);

$suspended='';
$notsuspended='';
if($CurrentUser->isSuspended){$active='checked';}
else{$notsuspended='checked';}

$public='';
$private='';
if($CurrentUser->isPublic){$public='checked';}
else{$private='checked';}

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
    <?php
      if($edited){
        echo("<div class='well'>");
        echo("Updated Successfully!");
        echo("</div>");
      }
    ?>
    <form action"EditUser.php" method="post">
      <input type="hidden" class="form-control" name="Edited"  value="true">
      <label for="name">First Name:</label>
      <input type="text" class="form-control" value=<?php echo('"'.$CurrentUser->FirstName.'"')?> name="firstname">
      <label for="name">Last Name:</label>
      <input type="text" class="form-control" value=<?php echo('"'.$CurrentUser->LastName.'"')?> name="lastname">
      <label for="dob">Date of Birth:</label>
      <input type="text" class="form-control" value=<?php echo('"'.$CurrentUser->DateOfBirth.'"')?> name="dob">
      <label for="interests">Interests:</label>
      <input type="text" class="form-control" value=<?php echo('"'.$CurrentUser->Interest.'"')?> name="interests">
      <label for="job">Job:</label>
      <input type="text" class="form-control" value=<?php echo('"'.$CurrentUser->Job.'"')?> name="job">
      <label for="emp">Employer:</label>
      <input type="text" class="form-control"value=<?php echo('"'.$CurrentUser->Employer.'"')?> name="emp">
      <label for="pfp">Profile Picture:</label>
      <input type="text" class="form-control" value=<?php echo('"'.$CurrentUser->ProfilePicture.'"')?> name="pfp">
      <label for="bio">Bio:</label>
      <textarea type="text" class="form-control" rows="3" name="bio" ><?php echo($CurrentUser->Bio);?></textarea>
      <div class="well">
      <label for="susp">Suspension Status:</label>
      <label class="radio-inline"><input type="radio" name="susp" value="Active" <?php echo($active);?>>Active</label>
      <label class="radio-inline"><input type="radio" name="susp" value="Suspended" <?php echo($suspended);?>>Suspended</label>
      </div>
      <div class = "well">
      <label for="priv">Privacy Status:</label>
      <label class="radio-inline"><input type="radio" name="priv" value="Public" <?php echo($public);?>>Public</label>
      <label class="radio-inline"><input type="radio" name="priv" value="Private" <?php echo($private);?>>Private</label>
      </div>
      <button type="submit" class="btn btn-primary btn-lg">Submit</button>
    </form>
  </div>
</div>

</body>
</html>
