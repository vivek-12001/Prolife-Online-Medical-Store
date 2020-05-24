<?php

session_start();
include("database.php");

if(!isset($_SESSION["username"]))
{
	header("location : index.php");
}

if(isset($_POST["product_id"]))
{

		$email_id = $_SESSION["username"];
		$query = "select * from customer_details where email_id = '$email_id'";
		$result = mysqli_query($connect,$query);
		$data = mysqli_fetch_array($result);
		$customer_id = $data["customer_id"];
		$product_id = $_POST["product_id"];
		$order_id = $_POST["order_id"];
		$query1 = "delete from order_details where product_id = '$product_id' and order_id = '$order_id'";
		$result = mysqli_query($connect,$query1);
		$query3 = "select * from order_details where order_id = '$order_id' and product_id = '$product_id'";
		$result3 = mysqli_query($connect,$query3);
	
$tabledata = '';
$message = '';
$total = 0;
$query2 = "select order_details.order_id,customer_details.customer_name,customer_details.address,customer_details.mobileno,customer_details.pincode,order_details.product_id,order_details.product_name,order_details.product_quantity,order_details.product_price,customer_order.order_date,customer_order.order_status from order_details NATURAL join customer_order NATURAL join customer_details where customer_order.customer_id = '$customer_id'";
$result2 = mysqli_query($connect,$query2);
$tabledata .= '  
    <table class="table table-bordered">  
        <tr>  
            <th width="40%"><h5>Product Name</h5></th>  
            <th width="7%"><h5>Quantity</h5></th>  
            <th width="7%"><h5>Price</h5></th>  
            <th width="15%"><h5>Order Date</h5></th>  
            <th width="15%"><h5>Order Status</h5></th>
			<th width="20%"><h5>Delivery Date</h5></th>
        </tr>   
';
while($row = mysqli_fetch_array($result2))
{
	$tabledata .='
		<tr> 
            <td><h6>'.$row["product_name"].'</h6></td>  
			<td><h6>'.$row["product_quantity"].'</h6></td>
			<td><h6>'.$row["product_price"].'</h6></td>
			<td><h6>'.$row["order_date"].'</h6></td>
			<td><h6>'.$row["order_status"].'</h6></td>
			<td><h6>'.date('jS F Y', strtotime(' + 2 days')).'</h6></td>
	';
			if($row["order_status"] == "pending")
			{
				$tabledata .=' <td><input type="hidden" name="orderid" id="orderid'.$row["product_id"].'" value="'.$row["order_id"].'" />
				<td><input type="hidden" name="productid" id="productid'.$row["product_id"].'" value="'.$row["product_id"].'" />
				</td><td><input type="submit" name="cancel" id="'.$row["product_id"].'" class="btn btn-primary btn-xs cancel" value="Cancel"/></td>
				';
			}
			if($row["order_status"] == "success")
			{
				$tabledata .=' <td><input type="hidden" name="orderid" id="orderid'.$row["product_id"].'" value="'.$row["order_id"].'" />
				<td><input type="hidden" name="productid" id="productid'.$row["product_id"].'" value="'.$row["product_id"].'" />
				</td><td><input type="submit" name="reorder" id="'.$row["product_id"].'" class="btn btn-danger btn-xs cancel" value="Reorder"/></td>
				';
			}
    $tabledata .=' </tr>';
}
$tabledata .= '</table>';
	
	$query4 = "select * from customer_details where $customer_id = '$customer_id'";
	$result4 = mysqli_query($connect,$query4);
	
	$customer_details = '';
	
	while($row = mysqli_fetch_array($result4))
    {
		$customer_details = '
			<p><h5>Customer Name :- '.$row["customer_name"].'</h5></p>
			<p><h5>Customer Address :- '.$row["address"].'</h5></p>
			<p><h5>City :- '.$row["city"].'</h5></p>
			<p><h5>Pincode :- '.$row["pincode"].'</h5></p>
		';                        
    }
	
	$order_details = '';
	
	$product_name = '';
	
	while($row = mysqli_fetch_array($result3))
    {
		$order_details .= '
            <tr>
				<td><h5>'.$row["product_name"].'</h5></td>
				<td><h5>'.$row["product_quantity"].'</h5></td>
				<td><h5>'.$row["product_price"].'</h5></td>
            </tr>
        ';    
		$product_name = $row["product_name"];
    }	
	
	$message .= 'Your Order '.$product_name.' Has Been Cancelled';
	
	$message .= '  
		<div class="container">
			<div id="box">
				<div class="table-responsive"> 
					<table class="table"> 
						<h5 align="center" style="color:blue;">Prolife : Online Medical Store</h5>
							<tr>  
								<td><p><h5>Customer Details<h5></p></td>  
                            </tr>  
							<tr>  
                                <td><h5>'.$customer_details.'</h5></td>  
                            </tr>  
                            <tr>  
                                <td><p><h5>Order Details</h5></p></td>  
                            </tr>  
                            <tr>  
                                <td>  
                                    <table class="table table-bordered">  
                                        <tr>  
                                            <th width="50%"><h5>Product Name</h5></th>  
                                            <th width="15%"><h5>Quantity</h5></th>  
                                            <th width="15%"><h5>Price</h5></th>  
                                        </tr>  
                                        <h5>'.$order_details.'</h5> 
                                    </table>  
                                </td>  
                            </tr>  
                    </table>  
                </div>  
			</div>
		</div>
    ';
	
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
	$mail->AddAddress('@gmail.com', 'Delivery Details');  //Adds a "To" address
	$mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);       //Sets message type to HTML
	//$mail->AddAttachment($path);     //Adds an attachment from a path on the filesystem
	$mail->Subject = 'Product Delivery Details';    //Sets the Subject of the message
	$mail->Body = $message;       //An HTML or plain text message body
	$mail->Send();       //Send an Email. Return true on success or false on error
					
echo $tabledata;
}
else
{
	echo "product id not set";
}

?>