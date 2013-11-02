
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Register on PHPNote">
  <meta name="author" content="Baldi Cristian">
  <title>PHPNote - Register</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/register.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <h1>PHPNote - I will remember <b>that</b> for you</h1><br><br><br>
    <form class="form-signin" method="post" action="php/register.php">
      <h3 class="form-signin-heading">Please fill the following fields to register...</h3>
      <input type="text" name="name" class="form-control" placeholder="Your Username" required autofocus>
      <input type="email" name="email" class="form-control" placeholder="Your Email" required>
      <input type="password" name="password" class="form-control" placeholder="Your Password" required>
      <?php
      if(isset($_GET["error"]))
      {
        require_once 'functions.php';
        echo "<br><div class='alert alert-danger'>" . validateData($_GET["error"]) . "</div>";
      } 
      ?>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
      <br><br><a class="registerNow" href="login.html">Have an account? Login now!</a>
    </form>


  </div> 
</body>
</html>
