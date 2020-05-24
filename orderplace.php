<?php
include("database.php");
session_start();
$connect1 = mysqli_connect("localhost","root","","prolife");
?>


 <!DOCTYPE html>  
 <html>  
      <head>  
	    <style> 
		body
		{
			background-color:#f1f1f1;
		}
        #box  
        {  
            width:800px;
			background-color:#ffffff;
            margin:0 auto;  
            padding:16px;  
            margin-top:10px;
			border:2px solid DodgerBlue;
			border-radius:3px;
			h5 {color: red;}
        }  
		</style>  
      </head>  
      <body>  
		<?php include('Navigation.php')?>
           <br />  
           <div class="container" style="width:800px;">  
                <?php
				
				if(isset($_POST["place_order"]))  
				{  
					$cvv = $_POST["cvv"];
					$name = $_POST["name"];
					$cardno = $_POST["cardno"];
					$month = $_POST["month"];
					$year = $_POST["year"];
					$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
					$customer_name = $_SESSION["username"];
					$query1 = "select * from customer_details where email_id = '$customer_name'";
					$result1 = mysqli_query($connect,$query1);
					$data1 = mysqli_fetch_array($result1);
					$customer_id = $data1["customer_id"];
					$query = "INSERT INTO payment_details (customer_id,images,cvv,cardno,fname,month,year) VALUES ('$customer_id','$file','$cvv','$cardno','$name','$month','$year')";  
					if(mysqli_query($connect, $query))
					{
						echo '<script>alert("Payment Details Entered Into Database..!!")</script>';
					}
					else
					{
						echo '<script>alert("Error")</script>';
					}
				}
                
                if(isset($_POST["place_order"]))
                {
					$customer_name = $_SESSION["username"];
					$query = "select * from customer_details where email_id = '$customer_name'";
					$result = mysqli_query($connect,$query);
					$data = mysqli_fetch_array($result);
					$customer_id = $data["customer_id"];
                    $insert_order = "insert into customer_order (customer_id,order_date,order_status) values ('$customer_id','".date('Y-m-d')."','pending')";
                    $order_id = "";
                    
                    if(mysqli_query($connect,$insert_order))
                    {
                        $order_id = mysqli_insert_id($connect);
                    }
                    else
                    {
                        echo "Error : " .$insert_order. "<br>" .mysqli_error($connect);
                    }
                    
                    $_SESSION["order_id"] = $order_id;
                    
                    $order_details = "";
					$order_details1 = "";
                    
                    $query1 = "select cart.product_id,product_details.product_name,product_details.product_price,cart.product_quantity from cart inner join product_details on cart.product_id = product_details.product_id where cart.customer_id = '$customer_id'";
                    $result1 = mysqli_query($connect,$query1);
					
					while($row = mysqli_fetch_array($result1))
					{
						$order_details .= "
							insert into order_details (order_id,product_id,product_name,product_price,product_quantity) values ('".$order_id."','".$row["product_id"]."','".$row["product_name"]."','".$row["product_price"]."','".$row["product_quantity"]."');
						";
						$product_id = $row["product_id"];
						$product_quantity = $row["product_quantity"];
						$order_details1 .= "
							update product_details set product_quantity = product_quantity - '$product_quantity' where product_id = '$product_id';
						";
					}
					
                    if(mysqli_multi_query($connect,$order_details))
                    {
							echo '<script>alert("You Have Successfully Placed The Order")</script>';
							echo '<script>window.location.href="orderplace.php"</script>';
					}
                    else
                    {
                        echo "Error : " .$order_details. "<br>" . mysqli_error($connect); 
                    }
					
					mysqli_multi_query($connect1,$order_details1);
					
                }
				
				if(isset($_SESSION["order_id"]))
                {
                    $customer_id = '';
                    $order_details = '';
                    $total = 0;
                    $query = '
                        select * from customer_order inner join order_details on order_details.order_id = customer_order.order_id inner join customer_details on customer_details.customer_id = customer_order.customer_id where customer_order.order_id = "'.$_SESSION["order_id"].'"
                    ';
                    
                    $result = mysqli_query($connect,$query);
                    
                    while($row = mysqli_fetch_array($result))
                    {
                        $customer_details = '
                            <p><h5>Customer Name :- '.$row["customer_name"].'</h5></p>
                            <p><h5>Customer Address :- '.$row["address"].'</h5></p>
                            <p><h5>City :- '.$row["city"].'</h5></p>
                            <p><h5>Pincode :- '.$row["pincode"].'</h5></p>
                        ';
                        
                        $order_details .= "
                            <tr>
                                <td><h5>".$row["product_name"]."</h5></td>
                                <td><h5>".$row["product_quantity"]."</h5></td>
                                <td><h5>".$row["product_price"]."</h5></td>
                                <td><h5>".number_format($row["product_quantity"] * $row["product_price"])."</h5></td>
                            </tr>
                        ";
                        
                        $total = $total + ($row["product_quantity"] * $row["product_price"]);
                    }
					
					$message = '';
                    
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
                                                   <th width="20%"><h5>Total</h5></th>  
                                              </tr>  
                                              <h5>'.$order_details.'</h5> 
                                              <tr>  
                                                   <td colspan="3" align="right"><label><h5>Total</h5></label></td>  
                                                   <td><h6>'.number_format($total, 2).'</h6></td>  
                                              </tr>  
                                         </table>  
                                    </td>  
                               </tr>  
                          </table>  
                     </div>  
					</div>
					</div>
                     ';
					echo $message;
					$message .= "Your Order will be delivered on ";
					$date1 =  date('jS F Y', strtotime(' + 2 days'));
					$message .= $date1;
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
                }
                ?>
            </div> 
		
		<?php include('Footer.php')?>
      </body>  
 </html> 