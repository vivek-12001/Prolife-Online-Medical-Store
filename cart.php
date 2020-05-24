<?php
include("database.php");
?>

<html>
 <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    
 </head>
 <body>
  <div class="container">
   <?php include('Navigation.php')?>
   <div class = "container" id = "result">
        <div class="table-responsive" id="order_table">  
            <table class="table table-bordered">  
                <tr>
                    <th width="40%">Product Name</th>  
                    <th width="10%">Quantity</th>  
                    <th width="20%">Price</th>  
                    <th width="15%">Total</th>  
                    <th width="5%">Action</th>  
                </tr>  
            </table>  
        </div>  
   </div>
  </div>
 </body>
</html>

<script>

$(document).ready(function(data){
    
    $(document).on('click','.delete',function(){
       var product_id = $(this).attr("id");
       var action = "remove";
       if(confirm("Are you sure you want to remove this product?"))
       {
           $.ajax({
              url : "addtocart.php",
              method : "post",
              data : {product_id : product_id, action:action},
              success : function(data)
              {
                  $('#order_table').html(data.order_table);
                  $('.badge').text(data.cart_item);
              }
           });
       }
       else
       {
           return false;
       }
    });
    
    $(document).on('keyup', '.quantity', function(){  
           var product_id = $(this).data("product_id");  
           var quantity = $(this).val();  
           var action = "quantity_change";  
           if(quantity != '')  
           {  
                $.ajax({  
                     url :"addtocart.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{product_id:product_id, quantity:quantity, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                     }  
                });  
           }  
      });
    
});

</script>