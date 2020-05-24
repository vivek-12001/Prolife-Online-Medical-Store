<?php
   //home.php
   session_start();
   if(!isset($_SESSION['username']))
   {
    header("location:index.php");
   }
   ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pro-Life</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body{
            margin: 0;
        }
    </style>
 </head>
 <body>
     <?php include("Navigation.php");include("Car.php");?>
 <br>
   <br />
   <div class="h4 pl-5 ml-5 mb-3">Browse Medicines and Health Products</div>
    <div class="h5 font-weight-light pl-5 ml-5 mb-3">Shop By Categories</div>
    <div class="container grey lighten-2">
  <?php include("Item_card.php") ?>
    </div>
   <?php include('Footer.php');?>
 </body>
</html>