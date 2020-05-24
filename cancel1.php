<?php

session_start();
include("database.php");

if(!isset($_SESSION["username"]))
{
	header("location : index.php");
}

if(isset($_POST["order_id"]))
{
	$message = "";
	$order_id = $_POST["order_id"];
	$query2 = "delete from order_details where order_id = '$order_id'";
	$result2 = mysqli_query($connect,$query2);
	$query1 = "delete from customer_order where order_id = '$order_id'";
	$result1 = mysqli_query($connect,$query1);
	$message .= "Your Order has been Cancelled";
	require 'class/class.phpmailer.php';
	$mail = new PHPMailer;
	$mail->IsSMTP();        //Sets Mailer to send message using SMTP
	$mail->Host = 'smtp.gmail.com';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = 587;        //Sets the default SMTP server port
	$mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = '';     //Sets SMTP username
	$mail->Password = '';     //Sets SMTP password
	$mail->SMTPSecure = 'tls';       //Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = '';     //Sets the From email address for the message
	$mail->FromName = "Prolife : Online Medical Store";    //Sets the From name of the message
	$mail->AddAddress('', 'Delivery Details');  //Adds a "To" address
	$mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);       //Sets message type to HTML
	//$mail->AddAttachment($path);     //Adds an attachment from a path on the filesystem
	$mail->Subject = 'Product Delivery Details';    //Sets the Subject of the message
	$mail->Body = $message;       //An HTML or plain text message body
	if($mail->Send())        //Send an Email. Return true on success or false on error
	{
		$message = '<div class="alert alert-success">Mail Sent Successfully</div>';
	}
	else
	{
		$message = '<div class="alert alert-danger">There is an Error</div>';
	}
	echo "success";
}
else
{
	echo "order id not set";
}

?>