<?php

session_start();
include("database.php");

if(!isset($_SESSION["username"]))
{
	header("location : index.php");
}

if(isset($_POST["doctor_id"]))
{
	$message = "";
	$customer_name = $_SESSION["username"];
	$query = "select * from customer_details where email_id = '$customer_name'";
	$result = mysqli_query($connect,$query);
	$data = mysqli_fetch_array($result);
	$customer_id = $data["customer_id"];
	$doctor_id = $_POST["doctor_id"];
	$query1 = "select * from doctor where id = '$doctor_id'";
	$result1 = mysqli_query($connect,$query1);
	$data1 = mysqli_fetch_array($result1);
	$doctor_name = $data1["name"];
	$message .= " Your Appointment has been successfully booked with ";
	$message .= "$doctor_name";
	require 'class/class.phpmailer.php';
	$mail = new PHPMailer;
	$mail->IsSMTP();        //Sets Mailer to send message using SMTP
	$mail->Host = 'smtp.gmail.com';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = 587;        //Sets the default SMTP server port
	$mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = '2017.vivek.choudhary@ves.ac.in';     //Sets SMTP username
	$mail->Password = 'Janhvi1810@';     //Sets SMTP password
	$mail->SMTPSecure = 'tls';       //Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = '2017.vivek.choudhary@ves.ac.in';     //Sets the From email address for the message
	$mail->FromName = "Prolife : Online Medical Store";    //Sets the From name of the message
	$mail->AddAddress('', 'Doctor Appointment');  //Adds a "To" address
	$mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);       //Sets message type to HTML
	//$mail->AddAttachment($path);     //Adds an attachment from a path on the filesystem
	$mail->Subject = 'Doctor Appointment';    //Sets the Subject of the message
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
	echo "doctor id not set";
}

?>