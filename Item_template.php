<?php
session_start();
include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pro-Life</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php include('Navigation.php')?>
        <main class="mt-5 pt-4">
        <div class="container dark-grey-text mt-5">
        <div class="row wow fadeIn">
            <?php
                $product_id = $_POST["senddata"];
				$_SESSION["product_id"] = $product_id;
                $query = "select * from product_details where product_id = '$product_id'";
                $result = mysqli_query($connect, $query);
                while($row = mysqli_fetch_array($result))
                {
            ?>
			<input type = "hidden" name = "hidden_id" id = "hidden_id" value = "<?php echo $row["product_name"]; ?>" >
            <div class="col-md-5 mb-4">
              <img src="images/<?php echo $row["product_image"]; ?>" class="img-responsive img-fluid" />
            </div>
            <div class="col-md-7 mb-4">
              <div class="p-4">
                <div class="mb-3">
                    <p class="lead font-weight-bold"><?php echo $row["product_name"]; ?></p>
                </div>
                <p class="lead">
                  <span><h4>Price - <?php echo $row["product_price"]; ?></h4></span>
                </p>
                <input type="hidden" name="hidden_name" id="name<?php echo $row["product_id"]; ?>" value="<?php echo $row["product_name"]; ?>" />  
                <input type="hidden" name="hidden_price" id="price<?php echo $row["product_id"]; ?>" value="<?php echo $row["product_price"]; ?>" />
                
				<p class="lead">
                  <span><h6>Remaining Quantity - <?php echo $row["product_quantity"]; ?></h6></span>
                </p>
				
				<?php
				if($row["product_status"] == 1)
				{
				?>
					<span class="badge green mr-1 mb-2">In Stock</span>
				<?php
				}
				?>
				
				<?php
				if($row["product_status"] == 0)
				{
				?>
					<span class="badge green mr-1 mb-2">Out of Stock</span>
				<?php
				}
				?>
                
				<p class="font-weight-bold mb-1">Quantity : </p>
                <div class="d-flex justify-content-left">
                <input type="text" name="quantity" id="quantity<?php echo $row["product_id"]; ?>" class="form-control" style="width: 100px" value="1" />
				<button class="btn btn-primary btn-md my-0 p addtocart" name="addtocart" id="<?php echo $row["product_id"]; ?>" type="submit" value="Add To Cart">Add to cart
                <i class="fas fa-shopping-cart ml-1"></i>
                </button>
                </div>
                </form>
              </div>
            </div>
        </div>
          <hr>
			<div class="row d-flex justify-content-center wow fadeIn">
    
			</div>
            <div class="col-md-8">
				<p class="font-weight-bold">Descriptions :</p>
                <p><p><?php echo $row["description"]; ?></p></p>    
			</div>
            <?php
                }
            ?>
    
        </div>
		
		<div class="col-md-8" style="width: 30rem; margin: 0 115px auto;">
			<div class="row d-flex justify-content-center wow fadeIn">
			</div>
		<p class="font-weight" style="color: #008CBA;">Write a review</p>
		<form method="POST" id="comment_form">
			<div class="form-group">
				<input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" />
			</div>
			<div class="form-group">
				<textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="3"></textarea>
			</div>
			<div class="form-group">
				<input type="hidden" name="product_id" id="product_id" value="<?php echo $GLOBALS["product_id"]; ?>" />
				<input type="submit" name="submit" id="submit" class="btn btn-info submit" value="Submit" />
			</div>
		</form>
		
		<span id="comment_message"></span>
		<br />
		<div id="display_comment"></div>
		
		</div>
		
		
		
        </div>
      </main>
      <?php include('Footer.php')?>
    </body>
</html>
<script>
$(document).ready(function(data){
	
	$('#comment_form').on('submit', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url:"product_add_comment.php",
			method:"POST",
			data:form_data,
			dataType:"json",
			success:function(data)
			{
				if(data.error != '')
				{
					$('#comment_form')[0].reset();
					$('#comment_message').html(data.error);
					load_comment();
				}
			}
		});
	});
	
	load_comment();

	function load_comment()
	{
	  $.ajax({
	   url:"product_fetch_comment.php",
	   method:"POST",
	   success:function(data)
	   {
		$('#display_comment').html(data);
	   }
	  })
	}
	
    $('.addtocart').click(function(){  
           var product_id = $(this).attr("id");
           var product_quantity = $('#quantity'+product_id).val();  
           if(product_quantity > 0)  
           {  
                $.ajax({  
                     url:"myaddtocart.php",  
                     method:"POST",  
                     data:{  
                          product_id:product_id,
                          product_quantity:product_quantity,   
                     },  
                     success:function(data)  
                     {  
                        alert("Product has been Added into Cart");  
                     }  
                });  
           }  
           else  
           {  
                alert("Please Enter Number of Quantity");
           }  
    });  
	
});
</script>