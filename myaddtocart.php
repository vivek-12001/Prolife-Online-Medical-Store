<?php

include("database.php");
session_start();
if(!isset($_SESSION["username"]))
{
	header("location:index.php");
}

if(isset($_POST["product_id"]))
{
	$email_id = $_SESSION["username"];
	$query = "select * from customer_details where email_id = '$email_id'";
	$result = mysqli_query($connect,$query);
	$data = mysqli_fetch_array($result);
	$customer_id = $data["customer_id"];
	$product_id = $_POST["product_id"];
	$product_quantity = $_POST["product_quantity"];
	$query1 = "select * from cart where customer_id = '$customer_id' and product_id = '$product_id'";
	$result1 = mysqli_query($connect,$query1);
	$count = mysqli_num_rows($result1);
	if($count == 0)
	{
		$query2 = "insert into cart (customer_id,product_id,product_quantity) values ('$customer_id','$product_id','$product_quantity')";
		$result2 = mysqli_query($connect,$query2);
		echo "Product added to cart";
	}
	else
	{
		$query3 = "update cart set product_quantity = '$product_quantity' where customer_id = '$customer_id' and product_id = '$product_id'";
		$result3 = mysqli_query($connect,$query3);
		echo "Product added to cart";
	}
}
else
{
	echo "Product Id not set";
}

?>