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
	$query = "select order_details.order_id,customer_details.customer_name,customer_details.address,customer_details.mobileno,customer_details.pincode,order_details.product_id,order_details.product_name,order_details.product_quantity,order_details.product_price,customer_order.order_date,customer_order.order_status from order_details NATURAL join customer_order NATURAL join customer_details where customer_order.customer_id = '$customer_id' and customer_order.order_status = 'pending'
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
    <div class="container" >
	<div id = "box">
		<div class="table-responsive" id="order_table">  
            <table class="table table-bordered">  
				<tr>  
                    <th width="40%"><h5>Order Date</h5></th>  
                    <th width="15%"><h5>Order Status</h5></th>  
                    <th width="15%"><h5>Delivery Date</h5></th>
					<th width="15%"><h5>Order Id</h5></th>
                </tr>
				<?php
					$query1 = "select * from customer_order where customer_id = '$customer_id' and order_status = 'pending'";
					$result1 = mysqli_query($connect,$query1);
					while($row1 = mysqli_fetch_array($result1))
					{
				?>
				<tr>
					<td><h6><?php echo $row1["order_date"]; ?></h6></td>
					<td><h6><?php echo $row1["order_status"]; ?></h6></td>
					<td><h6><?php echo date('jS F Y', strtotime(' + 2 days'));?></h6></td>
					<td><h6><?php echo $row1["order_id"]; ?></h6></td>
				</tr>
				<?php
					}
				?>
				<tr>  
                    <th width="40%"><h5>Product Name </h5></th>  
                    <th width="20%"><h5>Product Quantity</h5></th>  
                    <th width="20%"><h5>Product Price</h5></th>  
                </tr>
				<?php
				while($row = mysqli_fetch_array($result))
				{
				?>
					<tr> 
                          <td><h6><?php echo $row["product_name"]; ?></h6></td>  
						  <td><h6><?php echo $row["product_quantity"]; ?></h6></td>
						  <td><h6><?php echo $row["product_price"]; ?></h6></td>
						  <td><h6><?php echo $row["order_id"]; ?></h6></td>
                    </tr>
				<?php
				}
				?>
				<br>
			<tr>  
                <td colspan="5" align="center">  
                    <input type="submit" data-toggle="modal" data-target="#loginModal" name="cancel" class="btn btn-primary" value="Cancel Order"/>
                </td>  
            </tr>

            </table>  
        </div>	
		</div>
    </div>
</main>

<?php include('footer1.php')?>

</body>
</html>

<?php

function fillid($connect)
{
	$output = '';
	$customer_id = $GLOBALS['customer_id'];
	$query2 = "select * from customer_order where customer_id = '$customer_id' and order_status = 'pending'";
	$result2 = mysqli_query($connect,$query2);
	while($row2 = mysqli_fetch_array($result2))
	{
		$output .= '<option value="'.$row2["order_id"].'">'.$row2["order_id"].'</option>';
	}
	return $output;
}

?>

<div id="loginModal" class="modal fade" role="dialog">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body">  
                    <label>Select Order Id To Cancel</label> 
					<select name="orderid" id="orderid" class="form-control">  
                        <option value="">Show All Id</option>
						<?php echo fillid($connect); ?> 
                    </select>
                     <br />  
                     <button type="button" name="cancel" id="cancel" class="btn btn-warning cancel">CANCEL</button>  
                </div>  
           </div>  
      </div>  
</div>

<script>

$(document).ready(function(){  
    $('#cancel').click(function(){  
        var order_id = $('#orderid').val();  
        $.ajax({  
            url:"cancel1.php",  
            method:"POST",  
            data:{order_id:order_id},  
            success:function(data){  
                $('#order_table').html(data);
                alert("Order Successfully Cancelled...!!!"); 
				location.reload();
            }  
        });  
    });  
});  

</script>