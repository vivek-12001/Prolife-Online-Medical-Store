<html>
 <head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>Webslesson Tutorial</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container">
   <?php
   //home.php
   session_start();
   if(!isset($_SESSION['username']))
   {
    header("location: index.php");
   }
   echo '<h1 align="center">'.$_SESSION["username"].' - Welcome to Home Page</h1>';
   echo '<p align="center"><a href="logout.php">Logout</a></p>';
   ?>
  </div>
 </body>
</html>