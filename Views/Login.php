<?php
session_start();
session_unset();
$_SESSION['Last_Page'] = 'Login';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Generic Social Media Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../Services/Login_Service.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>Generic Social Media</h1>
  <p>Sign In Below</p> 
</div>
  
<div class="container">
  <div class="row">

    <form action = "../Services/Login_Service.php" method = "POST" id='login'>
      <input type="hidden" name = "hidden-button" id='inlogger' formaction='UserPage.php'  value="Login"></input>
      <div class = "well">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input type="text" class="form-control" name="email" placeholder="Username">
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-default">Log In</button>
      </div>
    </form>

  </div>
</div>

</body>
</html>
