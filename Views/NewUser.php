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

<div class="jumbotron text-center">
  <h1>Generic Social Media</h1>
  <p>Welcome! We just need you to give us some information.</p> 
</div>
  
<div class="container">
  <div class="row">

    <div class = "well">
      <label for="name">First, the boring stuff</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
        <input id="email" type="text" class="form-control" name="email" placeholder="Email">
      </div>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input id="email" type="text" class="form-control" name="email" placeholder="Password">
      </div>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input id="email" type="text" class="form-control" name="email" placeholder="Confirm Password">
      </div>
    </div>

    <div class = "well">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name">
      <label for="dob">Birthday:</label>
      <input type="text" class="form-control" id="dob">
      <label for="interests">Interests:</label>
      <input type="text" class="form-control" id="interests">
      <label for="job">Job:</label>
      <input type="text" class="form-control" id="job">
      <label for="emp">Employer:</label>
      <input type="text" class="form-control" id="emp">
      <label for="bio">Tell us about yourself:</label>
      <textarea class="form-control" rows="5" id="bio"></textarea>
  </div>
  <button type="button" class="btn btn-primary">Submit</button>
  </div>
</div>

</body>
</html>
