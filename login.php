
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Login on PHPNote">
  <meta name="author" content="Baldi Cristian">
  <title>PHPNote - Login</title>
  <link href="css/bootstrap.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <h1>PHPNote - I will remember <b>that</b> for you</h1><br><br><br>
    <form class="form-signin" method="post" action="php/login.php">
      <h3 class="form-signin-heading">Please fill the following fields to login...</h3>
      <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required autofocus>
      <input type="password" class="form-control" id="password" name="password" placeholder="Your Password" required>
      <?php
      if(isset($_GET["error"]))
      {
        require_once 'functions.php';
        echo "<br><div class='alert alert-danger'>" . validateData($_GET["error"]) . "</div>";
      }
      ?>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      <br><br><a class="registerNow" href="register.html">Don't have an account? Register Now!</a>
    </form>

  </div> 
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
