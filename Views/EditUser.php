<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Generic Social Media</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="#">User Page</a></li>
      <li class="active"><a href="#">Edit User</a></li>
      <li><a href="#">Manage Friends</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-minus-sign"></span> Logout</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
  <div class="col-sm-6">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name">
    <label for="dob">Date of Birth:</label>
    <input type="text" class="form-control" id="dob">
    <label for="interests">Interests:</label>
    <input type="text" class="form-control" id="interests">
    <label for="job">Job:</label>
    <input type="text" class="form-control" id="job">
    <label for="emp">Employer:</label>
    <input type="text" class="form-control" id="emp">
    <label for="pfp">Profile Picture:</label>
    <input type="text" class="form-control" id="pfp">
    <label for="bio">Bio:</label>
    <textarea class="form-control" rows="5" id="bio"></textarea>
    <label for="susp">Suspension Status:</label>
    <label class="radio-inline"><input type="radio" name="susp" checked>Active</label>
    <label class="radio-inline"><input type="radio" name="susp">Suspended</label>
    <label for="priv">Privacy Status:</label>
    <label class="radio-inline"><input type="radio" name="priv" checked>Public</label>
    <label class="radio-inline"><input type="radio" name="priv">Private</label>
    <button type="button" class="btn btn-primary btn-lg">Submit</button>
  </div>
</div>

</body>
</html>
