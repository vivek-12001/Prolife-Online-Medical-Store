
<?php
	session_start();
	include("database.php");
	if(!isset($_SESSION["username"]))
	{
		header("location : index.php");
	}	
?>

<html>
 <head>
  <title>Cart</title>
 </head>
 <body>
     <?php include('Navigation.php')?>
	 
	<br><br>
   
    <div class = "container" id = "result">
        <div class="table-responsive" id="order_table">  
            <table class="table table-bordered">  
                <tr>  
                    <th width="50%"><h5>Product Name</h5></th>  
                    <th width="15%"><h5>Quantity</h5></th>  
                    <th width="15%"><h5>Price</h5></th>  
                    <th width="15%"><h5>Total</h5></th>  
                    <th width="5%"><h5>Action<h5></th>
					<th width="5%"><h5>Edit<h5></th>
                </tr>  
				
			<?php
				$customer_name = $_SESSION["username"];
				$query = "select * from customer_details where email_id = '$customer_name'";
				$result = mysqli_query($connect,$query);
				$data = mysqli_fetch_array($result);
				$customer_id = $data["customer_id"];
				$query1 = "SELECT cart.product_id,product_details.product_name,product_details.product_price,cart.product_quantity FROM cart inner join product_details on cart.product_id = product_details.product_id where cart.customer_id = '$customer_id' order by cart.product_id asc";
				$result1 = mysqli_query($connect,$query1);
				if(mysqli_num_rows($result1) == 0)
				{
					echo '
						<tr>  
							<td colspan="5" align="center">  
							<h2>No product in cart...!!!</h2> 
							</td>  
						</tr>
					';
				}
				else
				{
			?>
			<?php
				$total = 0;
				while($row = mysqli_fetch_array($result1))
				{
			?>
					<tr> 
                          <td><h6><?php echo $row["product_name"]; ?></h6></td>  
						  <td><input type="text" name="quantity[]" id="quantity<?php echo $row["product_id"]; ?>" value="<?php echo $row["product_quantity"]; ?>" class="form-control quantity"/></td>
                          <td align="center"><h6>$<?php echo $row["product_price"]; ?></h6></td>  
                          <td align="center"><h6>$<?php echo number_format($row["product_quantity"] * $row["product_price"], 2); ?></h6></td>  
						  <td><input type="button" name="delete" id="<?php echo $row["product_id"]; ?>" class="btn btn-danger btn-xs delete" value="Remove"/></td>
						  <td><input type="button" name="edit" id="<?php echo $row["product_id"]; ?>" class="btn btn-info btn-xs edit" value="Update"/></td>
                    </tr>
			<?php
				$total = $total + ($row["product_quantity"] * $row["product_price"]);
				}
				echo '
					<tr>  
						<td colspan="3" align="right"><h5>Total</h5></td>  
						<td align="right"><h4>$'.number_format($total, 2).'</h4></td>  
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
				}
			?>
				
            </table>  
        </div>  
    </div>
  <?php include('Footer.php')?>
 </body>
</html>

<script>

$(document).ready(function(data){
    
	$(document).on('click','.edit',function(){
        var product_id = $(this).attr("id");
	    var quantity = $('#quantity'+product_id).val();
        if(quantity != '' && quantity != 0)  
        {  
            $.ajax({  
                url :"cart2.php",  
                method:"POST",  
                data:{product_id:product_id, quantity:quantity},  
                success:function(data){  
                    $('#order_table').html(data);  
                }  
            });  
        }
		else
		{
			alert("Please Enter Number of Quantity");
		}
    });
	
	$(document).on('click','.delete',function(){
       var product_id = $(this).attr("id");
	   var action = "delete";
       if(confirm("Are you sure you want to remove this product?"))
       {
           $.ajax({
              url : "cart1.php",
              method : "post",
              data : {product_id : product_id, action:action},
              success : function(data)
              {
                  alert("product removed");
				  $('#order_table').html(data);
              }
           });
       }
       else
       {
           return false;
       }
    });

});
</script>