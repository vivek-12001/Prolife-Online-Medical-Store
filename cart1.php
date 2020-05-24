<?php

session_start();
include("database.php");

if(!isset($_SESSION["username"]))
{
	header("location : index.php");
}

if(isset($_POST["product_id"]))
{
	if($_POST["action"] == "delete")
	{
		$email_id = $_SESSION["username"];
		$query = "select * from customer_details where email_id = '$email_id'";
		$result = mysqli_query($connect,$query);
		$data = mysqli_fetch_array($result);
		$customer_id = $data["customer_id"];
		$product_id = $_POST["product_id"];
		$query1 = "delete from cart where customer_id = '$customer_id' and product_id = '$product_id'";
		$result = mysqli_query($connect,$query1);
	}
	
$tabledata = '';
$message = '';
$total = 0;
$query2 = "SELECT cart.product_id,product_details.product_name,product_details.product_price,cart.product_quantity FROM cart inner join product_details on cart.product_id = product_details.product_id where cart.customer_id = '$customer_id' order by cart.product_id asc";
$result2 = mysqli_query($connect,$query2);
$tabledata .= '  
    <table class="table table-bordered">  
        <tr>  
            <th width="50%"><h5>Product Name</h5></th>  
            <th width="15%"><h5>Quantity</h5></th>  
            <th width="15%"><h5>Price</h5></th>  
            <th width="15%"><h5>Total</h5></th>  
            <th width="5%"><h5>Action<h5></th>
			<th width="5%"><h5>Edit<h5></th>
        </tr>  
';
while($row = mysqli_fetch_array($result2))
{
	$tabledata .='
		<tr> 
            <td><h6>'.$row["product_name"].'</h6></td>  
            <td><input type="text" name="quantity[]" id="quantity'.$row["product_id"].'" value="'.$row["product_quantity"].'" class="form-control quantity"/></td>  
            <td align="center"><h6>$'.$row["product_price"].'</h6></td>  
            <td align="center"><h6>$'.number_format($row["product_quantity"] * $row["product_price"], 2).'</h6></td>  
            <td><button name="delete" class="btn btn-danger btn-xs delete" id="'.$row["product_id"].'">Remove</button></td>
			<td><button name="edit" class="btn btn-info btn-xs edit" id="'.$row["product_id"].'">Update</button></td> 
        </tr>
	';
	$total = $total + ($row["product_quantity"] * $row["product_price"]);
}
$tabledata .= '  
    <tr>  
        <td colspan="3" align="right"><h5>Total</h5></td>  
        <td align="right"><h6>$'.number_format($total, 2).'</h6></td>  
    </tr>  
	<tr>  
        <td colspan="5" align="center">  
            <form method="post" action="checkout.php">  
                <input type="submit" name="buy" class="btn btn-warning" value="Checkout"/>
            </form>  
        </td>  
    </tr>
	<tr>  
        <td colspan="5" align="center">  
            <form method="post" action="clearcart.php">  
                <input type="submit" name="clearcart" class="btn btn-dark" value="Clear Cart"/>
            </form>  
        </td>  
    </tr>
';
$tabledata .= '</table>';
echo $tabledata;
}
else
{
	echo "product id not set";
}

?>