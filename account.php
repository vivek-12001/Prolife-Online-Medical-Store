<?php
	session_start();
	include("database.php");
	if(!isset($_SESSION["username"]))
	{
		header("location : index.php");
	}	
	$customer_name = $_SESSION["username"];
	$query = "select * from customer_details where email_id = '$customer_name'";
	$result = mysqli_query($connect,$query);
	$data = mysqli_fetch_array($result);
	$customer_id = $data["customer_id"];
	$query = "select * from customer_details where customer_id = '$customer_id'";
	$result = mysqli_query($connect,$query);
	if(isset($_POST["register"]))  
	{  
        $name = mysqli_real_escape_string($connect, $_POST["name"]); 
        $address = mysqli_real_escape_string($connect, $_POST["address"]);
        $mobileno = mysqli_real_escape_string($connect, $_POST["mobileno"]);
        $emailid = mysqli_real_escape_string($connect, $_POST["emailid"]);
        $pincode = mysqli_real_escape_string($connect, $_POST["pincode"]);
        $password = mysqli_real_escape_string($connect, $_POST["password"]);
		$password = md5($password);
        $city = mysqli_real_escape_string($connect, $_POST["city"]);
        $query1 = "update customer_details set customer_name = '$name', address = '$address', city = '$city', pincode = '$pincode', mobileno = '$mobileno', email_id = '$emailid', password = '$password' where customer_id = '$customer_id'";  
        if(mysqli_query($connect, $query1))  
        {  
            echo '<script>alert("Information Updated")</script>'; 
        }  
        else
        {
            echo '<script>alert("error" . $query . mysqli_error($connect))</script>';
        } 
	}
?>

<html>

<head>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
	
	<title>Edit Profile</title>

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
            margin-top:100px;
			border:1px solid #ccc;
			border-radius:5px;
        }  
    </style>

</head>
<body>

<header>

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark pink scrolling-navbar">
        <a class="navbar-brand" href="home.php"><strong>Prolife</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
				<li class="nav-item">
                    <a class="nav-link" href="account.php">EDIT PROFILE </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order.php">MANAGE ORDERS</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="mycart.php">CART</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="doctor.php">SEARCH DOCTOR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="livechat.php">LIVE CHAT WITH DOCTOR</a>
                </li>
            </ul>
            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">LOGOUT</a>
                </li>
            </ul>
        </div>
    </nav>

</header>

<main>
    <div class="container" style="width:500px;">
	<?php
		
		while($row = mysqli_fetch_array($result))
		{
	?>
		<div id="box">
            <br />  
            <div class="h2">Edit Profile</div>
            <hr>
            <form method="post">  
                <input type="text" value = "<?php echo $row["customer_name"]; ?>" name="name" class="form-control" pattern="[a-zA-Z\s]+" placeholder="Name" required/>  
                <br />  
                <input type="text" value = "<?php echo $row["mobileno"]; ?>" name="mobileno" class="form-control" id="mvalid" placeholder="Mobile/Phone" pattern="[7-9]{1}[0-9]{9}" required/>  
                <br />  
                <input type="text" value = "<?php echo $row["address"]; ?>" name="address" class="form-control" placeholder="Address" required/>  
                <br />
                <input type="text" value = "<?php echo $row["city"]; ?>" name="city" class="form-control" placeholder="City" pattern="[a-zA-Z\s]+" required/>
                <br />
                <input type="text" value = "<?php echo $row["pincode"]; ?>" name="pincode" class="form-control" placeholder="Pincode" required/>  
                <br />
                <input type="text" value = "<?php echo $row["email_id"]; ?>" name="emailid" class="form-control" placeholder="Username" required>
                <br />
                <input type="password" value = "<?php echo $row["password"]; ?>" name="password" class="form-control" placeholder="Password" required/>  
                <br />
                <input type="submit" id = "<?php $customer_id; ?>" name="register" value="Update" class="btn btn-danger mb-5 update" />  
            </form> 
		</div>  
	<?php
		}
	?> 
    </div>
</main>

<?php include('footer1.php')?>

</body>
</html>