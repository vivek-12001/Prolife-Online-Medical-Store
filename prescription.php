<!DOCTYPE html>
<html>
    <head>
        <title>Prescription Template</title>
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
    <div class="h5 font-weight-light pl-5 ml-5 mb-3">Shop By Prescription Categories</div>
    <div class="container grey lighten-2">
	
  <div class="card-group">
  <div class="card">
    <img src="images/skincare.webp" class="card-img-top" alt="skincare">
  </div>
  <div class="card">
    <img src="images/bodycare.webp" class="card-img-top" alt="bodycare">
  </div>
  <div class="card">
    <img src="images/hygiene.webp" class="card-img-top" alt="hygiene">
  </div>
</div>

<div class="card-group">
  <div class="card">
    <img src="images/oralcare.webp" class="card-img-top" alt="oralcare">
  </div>
  <div class="card">
    <img src="images/haircare.webp" class="card-img-top" alt="haircare">
  </div>
  <div class="card">
    <img src="images/babycare.webp" class="card-img-top" alt="babycare">
  </div>
</div>

    </div>
   <?php include('Footer.php');?>
 </body>
</html>