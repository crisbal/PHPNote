<?php 
  session_start();
  if(!isset($_SESSION["logged"]))
  {
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
  <title>PHPNote - Creating a note...</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  
</head>

<body>
  <div class="container">
    <h1>PHPNote - I will remember <b>that</b> for you</h1><br><br><br>
    <div class="alert alert-info">Write your note then press the button to save it.</div>
    <form class="createNote" method="post" action="php/create.php" autocomplete="off">
       <?php
        if(isset($_GET["error"]))
        {
          require_once 'php/functions.php';
          echo "<br><div class='alert alert-danger'>" . validateData($_GET["error"]) . "</div>";
        }
        ?>
        <input autocomplete="off" class="form-control title" type="text" id="title" name="title" placeholder="Insert a title for your note here..." autofocus>
        <textarea name="text" id="text" cols="30" rows="10" class="form-control text" placeholder="Insert your note here..." ></textarea>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Save the note</button>
    </form>

  </div> 
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
    $('.createNote').submit(function()
    {
        if ($(this).children('.title').val().trim().length == 0 && $(this).children('.text').val().trim().length == 0) { 
            alert("Please fill at least one field!")
            return false; 
        }
    });
  </script> 
</body>
</html>