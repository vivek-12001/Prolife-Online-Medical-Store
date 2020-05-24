<!DOCTYPE html>
<html>
    <head>
        <title>Personal Care</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body{
            margin: 0;
        }
    </style>
 </head>
 <body>
     <?php include("Navigation.php");include("personalcarousel.php");?>
 <br>
   <br />
    <div class="h5 font-weight-light pl-5 ml-5 mb-3">Shop By Categories</div>
    <div class="container grey lighten-2 getimageid">
	
		<div class="card-group">
		<div class="card">
			<a href = "skincare.php"><img src="images/skincare.webp" class="card-img-top" alt="skincare" value = "1"></a>
		</div>
		<div class="card">
			<a href = "bodycare.php"><img src="images/bodycare.webp" class="card-img-top" alt="bodycare" value = "2">
		</div>
		<div class="card">
			<a href = "hygiene.php"><img src="images/hygiene.webp" class="card-img-top" alt="hygiene" value = "3">
		</div>
		</div>

		<div class="card-group">
		<div class="card">
			<a href = "oralcare.php"><img src="images/oralcare.webp" class="card-img-top" alt="oralcare" value = "4">
		</div>
		<div class="card">
			<a href = "haircare.php"><img src="images/haircare.webp" class="card-img-top" alt="haircare" value = "5">
		</div>
		<div class="card">
			<a href = "babycare.php"><img src="images/babycare.webp" class="card-img-top" alt="babycare" value = "6">
		</div>
		</div>
		
    </div>
   <?php include('Footer.php');?>
   
 </body>
</html>