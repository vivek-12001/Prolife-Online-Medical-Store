<?php  
    
 include("database.php");  
 if(isset($_POST["register"]))  
 {  
	$email1 = $_POST["emailid"];
	$query1 = mysqli_query($connect, "select * from customer_details where email_id = '$email1'");
	$count = mysqli_num_rows($query1);
	if($count == 0)
	{
        $name = mysqli_real_escape_string($connect, $_POST["name"]); 
        $address = mysqli_real_escape_string($connect, $_POST["address"]);
        $mobileno = mysqli_real_escape_string($connect, $_POST["mobileno"]);
        $emailid = mysqli_real_escape_string($connect, $_POST["emailid"]);
        $pincode = mysqli_real_escape_string($connect, $_POST["pincode"]);
        $password = mysqli_real_escape_string($connect, $_POST["password"]);
		$password = md5($password);
        $city = mysqli_real_escape_string($connect, $_POST["city"]);
        $query = "INSERT INTO customer_details (customer_name,address,city,pincode,mobileno,email_id,password) VALUES ('$name','$address','$city','$pincode','$mobileno','$emailid','$password')";  
        if(mysqli_query($connect, $query))  
        {  
            echo '<script>alert("Registration Done")</script>'; 
        }  
        else
        {
            echo '<script>alert("error" . $query . mysqli_error($connect))</script>';
        }  
	}
	else
	{
		echo '<script>alert("Username Already Exists")</script>';
	}
 }  

?>  
<!DOCTYPE html>  
<html>  
    <head>
        <title>Create New Account</title>
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
            margin-top:10px;
			border:1px solid #ccc;
			border-radius:5px;
        }  
        </style>
      </head>  
    <body>
        <?php include('Navigation.php')?>
           <br />  
           <div class="container" style="width:500px;">  
		   <div id="box">
                <br />  
                <div class="h2">Join Pro-Life</div>
                <hr>
                <form method="post">  
                     <input type="text" name="name" class="form-control" pattern="[a-zA-Z\s]+" placeholder="Name" required/>  
                     <br />  
                     <input type="text" name="mobileno" class="form-control" id="mvalid" placeholder="Mobile/Phone" pattern="[7-9]{1}[0-9]{9}" required/>  
                     <br />  
                     <input type="text" name="address" class="form-control" placeholder="Address" required/>  
                     <br />
                     <input type="text" name="city" class="form-control" placeholder="City" pattern="[a-zA-Z\s]+" required/>
                     <br />
                     <input type="text" name="pincode" class="form-control" placeholder="Pincode" required/>  
                     <br />
                     <input type="text" name="emailid" class="form-control" placeholder="Username" required>
                     <br />
                     <input type="password" name="password" class="form-control" placeholder="Password" required/>  
                     <br />
                     <input type="submit" name="register" value="Create New Account" class="btn btn-info mb-5" />  
                </form> 
				<p align="center"><a href="index.php">LOGIN</a></p>
			</div>
           </div>
        <?php include('Footer.php')?>  
    </body>  
 </html>  