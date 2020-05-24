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
$query1 = "DELETE FROM cart WHERE customer_id = '$customer_id';";
$result1 = mysqli_query($connect,$query1);
header("location:mycart.php");

?>