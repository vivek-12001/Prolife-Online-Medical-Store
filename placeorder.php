<?php  
 
 include("database.php");
 session_start();  
 
?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:800px;">  
                <?php  
                
                if(isset($_POST["place_order"]))  
                {  
                     $insert_order = "INSERT INTO customer_order(customer_id,order_date, order_status) VALUES (1,'".date('Y-m-d')."', 'pending')";  
                     $order_id = "";  
                     if(mysqli_query($connect, $insert_order))  
                     {  
                          $order_id = mysqli_insert_id($connect);  
                     } 
                     else 
                     {
                        echo "Error: " . $insert_order . "<br>" . mysqli_error($connect);
                     }
                     $_SESSION["order_id"] = $order_id;  
                     $order_details = "";  
                     foreach($_SESSION["shopping_cart"] as $keys => $values)  
                     {  
                          $order_details .= "  
                          INSERT INTO order_details(order_id, product_name, product_price, product_quantity)  
                          VALUES('".$order_id."', '".$values["product_name"]."', '".$values["product_price"]."', '".$values["product_quantity"]."');  
                          ";  
                     }  
                     if(mysqli_multi_query($connect, $order_details))  
                     {  
                          unset($_SESSION["shopping_cart"]);  
                          echo '<script>alert("You have successfully place an order...Thank you")</script>';  
                          echo '<script>window.location.href="placeorder.php"</script>';  
                     }  
                     else 
                     {
                        echo "Error: " . $order_details . "<br>" . mysqli_error($connect);
                     }
                }  
                if(isset($_SESSION["order_id"]))  
                {  
                     $customer_details = '';  
                     $order_details = '';  
                     $total = 0;  
                     $query = '  
                     SELECT * FROM customer_order  
                     INNER JOIN order_details  
                     ON order_details.order_id = customer_order.order_id  
                     INNER JOIN customer_details  
                     ON customer_details.customer_id = customer_order.customer_id  
                     WHERE customer_order.order_id = "'.$_SESSION["order_id"].'"  
                     ';  
                     $result = mysqli_query($connect, $query);  
                     while($row = mysqli_fetch_array($result))  
                     {  
                          $customer_details = '  
                          <label>'.$row["customer_name"].'</label>  
                          <p>'.$row["address"].'</p>  
                          <p>'.$row["city"].', '.$row["pincode"].'</p>  
                          <p>'.$row["mobileno"].'</p>  
                          ';  
                          $order_details .= "  
                               <tr>  
                                    <td>".$row["product_name"]."</td>  
                                    <td>".$row["product_quantity"]."</td>  
                                    <td>".$row["product_price"]."</td>  
                                    <td>".number_format($row["product_quantity"] * $row["product_price"], 2)."</td>  
                               </tr>  
                          ";  
                          $total = $total + ($row["product_quantity"] * $row["product_price"]);  
                     }  
                     echo '  
                     <h3 align="center">Order Summary for Order No.'.$_SESSION["order_id"].'</h3>  
                     <div class="table-responsive">  
                          <table class="table">  
                               <tr>  
                                    <td><label>Customer Details</label></td>  
                               </tr>  
                               <tr>  
                                    <td>'.$customer_details.'</td>  
                               </tr>  
                               <tr>  
                                    <td><label>Order Details</label></td>  
                               </tr>  
                               <tr>  
                                    <td>  
                                         <table class="table table-bordered">  
                                              <tr>  
                                                   <th width="50%">Product Name</th>  
                                                   <th width="15%">Quantity</th>  
                                                   <th width="15%">Price</th>  
                                                   <th width="20%">Total</th>  
                                              </tr>  
                                              '.$order_details.'  
                                              <tr>  
                                                   <td colspan="3" align="right"><label>Total</label></td>  
                                                   <td>'.number_format($total, 2).'</td>  
                                              </tr>  
                                         </table>  
                                    </td>  
                               </tr>  
                          </table>  
                     </div>  
                     ';  
                }  
                ?>  
           </div>  
      </body>  
 </html> 