<?php 
  session_start(); 
  $connect = mysqli_connect("localhost", "root", "", "prolife");
  
	  $username = $_POST["username"];
	  $password = $_POST["password"];
	  $password = md5($password);
	  $sql = "SELECT * FROM customer_details WHERE email_id = '$username' AND password = '$password'";
	  $results = mysqli_query($connect, $sql);
	  $num_rows = mysqli_num_rows($results);
	  if($num_rows > 0)
	  {
		  $data = mysqli_fetch_array($results);
		  $_SESSION['username'] = $data["email_id"];
		  header("location:home.php");
	  }
	  else {
          $_SESSION['error_message'] = "wrong username or password";
          header("location:index.php");
      }
	  
?>