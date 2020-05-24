<?php  

session_start();
if(isset($_SESSION['username']))
{
 header('location:home.php');
}

?>  
<!DOCTYPE html>  
<html>  
    <head>  
    <style> 
	body
	{
		background-color:#f1f1f1;
	}
        #box  
        {  
            width:500px;
			background-color:#ffffff;
            margin:0 auto;  
            padding:16px;  
            text-align:center;  
            margin-top:50px;
			border:1px solid #ccc;
			border-radius:5px;
        }  
        </style>  
 </head>  
 <body>  
 <?php include('Navigation.php')?>
  <div class="container">
   <br />
   <div id="box">
    <h2>Login</h2>
    <br />
    <span id="error_message"> 
	<?php
	if(isset($_SESSION['error_message']))
	{
		echo $_SESSION['error_message'];
		unset($_SESSION['error_message']);
	}
	?>
	</span>
    <form method="post" action = "login.php" id="login_form">
     <input type="text" name="username" placeholder="Enter Email" class="form-control" required /><br />
     <input type="password" name="password" placeholder="Enter Password" class="form-control" required /><br />
     <input type="submit" name="submit" id="submit" class="btn btn-info" value="Login" />
    </form>
	<br>
	<form method="post" action = "signup.php" id="signup">
	<input type="submit" name="submit" id="submit" class="btn btn-danger" value="Create Account" />
	</form>
    <br /><br />  
   </div>
  </div>
  <?php include('Footer.php')?>
    </body>  
</html>