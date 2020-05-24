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
	$query = "select order_details.order_id,customer_details.customer_name,customer_details.address,customer_details.mobileno,customer_details.pincode,order_details.product_id,order_details.product_name,order_details.product_quantity,order_details.product_price,customer_order.order_date,customer_order.order_status from order_details NATURAL join customer_order NATURAL join customer_details where customer_order.customer_id = '$customer_id'
";
	$result = mysqli_query($connect,$query);
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
	
	<title>Manage Your Orders</title>

	<style> 
		body
		{
			background-color:#f1f1f1;
		}
        #box  
        {  
            margin-top:100px;
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
    <div class="container" >
	<div id = "box">
		<div class="table-responsive" id="order_table">  
            <table class="table table-bordered">  
                <tr>  
                    <th width="40%"><h5>Product Name</h5></th>  
                    <th width="7%"><h5>Quantity</h5></th>  
                    <th width="7%"><h5>Price</h5></th>  
                    <th width="15%"><h5>Order Date</h5></th>  
                    <!--<th width="15%"><h5>Order Status</h5></th>
					<th width="20%"><h5>Delivery Date</h5></th>-->
                </tr>   
				
			<?php
				while($row = mysqli_fetch_array($result))
				{
			?>
					<tr> 
                          <td><h6><?php echo $row["product_name"]; ?></h6></td>  
						  <td><h6><?php echo $row["product_quantity"]; ?></h6></td>
						  <td><h6><?php echo $row["product_price"]; ?></h6></td>
						  <td><h6><?php echo $row["order_date"]; ?></h6></td>
						  <td><h6><?php echo $row["order_status"]; ?></h6></td>
						  <td><h6><?php echo date('jS F Y', strtotime(' + 2 days'));?></h6><td>
						  <?php
						  if($row["order_status"] == "pending")
						  {
						  ?>
						    <td><input type="hidden" name="orderid" id="orderid<?php echo $row["product_id"]; ?>" value="<?php echo $row["order_id"]; ?>" />
							<td><input type="hidden" name="productid" id="productid<?php echo $row["product_id"]; ?>" value="<?php echo $row["product_id"]; ?>" />
							</td><td><input type="submit" name="cancel" id="<?php echo $row["product_id"]; ?>" class="btn btn-primary btn-xs cancel" value="Cancel"/></td>
						  <?php
						  }
						  ?>
						  <?php
						  if($row["order_status"] == "success")
						  {
						  ?>
						    <td><input type="hidden" name="orderid" id="<?php echo $row["product_id"]; ?>" value="<?php echo $row["order_id"]; ?>" />
							<td><input type="hidden" name="productid" id="<?php echo $row["product_id"]; ?>" value="<?php echo $row["product_id"]; ?>" />
							</td><td><input type="submit" name="reorder" id="<?php echo $row["product_id"]; ?>" class="btn btn-danger btn-xs reorder" value="Reorder"/></td>
						  <?php
						  }
						  ?>
                    </tr>
			<?php
				}
			?>
				
            </table>  
        </div>	
		</div>
    </div>
</main>

<?php include('footer1.php')?>

</body>
</html>

<script>

$(document).ready(function(data){
    $('.cancel').click(function(){  
		   var product_id = $(this).attr("id");
           var order_id = $('#orderid'+product_id).val();  
            $.ajax({  
                url:"cancel.php",  
                method:"POST",  
                data:{  
                    product_id:product_id,
					order_id:order_id
                },  
                success:function(data)  
                {  
					$('#order_table').html(data);
                    alert("Order Cancelled");  
                }  
                });  
      });
    
});

</script>
