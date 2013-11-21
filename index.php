<?php 
session_start();
if(isset($_SESSION["logged"]))
{
  if($_SESSION["logged"]==true)
    header("Location: login.php?error=Error: Please login to create a note.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Login on PHPNote">
  <meta name="author" content="Baldi Cristian">
  <title>PHPNote - I will remember that for you</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/note.css" rel="stylesheet">
</head>

<body>

  <div class="container">
    <h1>PHPNote - I will remember <b>that</b> for you</h1><br><br><br>

    <div class="note welcome">
      <div class="noteTitle">Welcome!</div>
      <div class="noteText">With this website you will be able to <b>save text notes</b> on the <b>cloud</b> and access them <b>from every device</b> you own (as long it is connected to the internet).<br><br>To get started <b><a href="register.php">register</a></b>, it only takes a few seconds. <br><br>
        Already have an account? <b><a href="login.php">Login now!</a></b></div>
        <div class="noteDateTime">This should be hidden and you know it.</div>
      </div>

      <div class="glyphicon glyphicon-cloud-upload" style="width:100%;text-align:center;font-size:15em;"> </div>
    </div>
   
    <div style="text-align:center">
      <a href="https://github.com/cris9696/PHPNote"><h3>Fork me on GitHub</h3></a>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
  </html>
