<?php
include("database.php");
?>

<html>
 <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  
    <style>
        .card:hover{
            box-shadow: 0 0 0.5rem rgb(214, 214, 214);
        }
        #nd-box { 
            float:left; 
            width:50%; 
            height:160px; 
            background-color:white;  
            margin-left:60px; 
        }
    </style>
 </head>
 <body>
  <div class="container">
   <br />
   <div class = "container dark-grey-text mt-5" id = "result">
        <ul class = "nav nav-tabs">
           <li class="active"><a data-toggle="tab" href="#products">Product</a></li>  
           <li><a data-toggle="tab" href="#cart">Cart <span class="badge"> </span></a></li>
        </ul> 
        <div class = "tab-pane fade in active" id = "products">
        <?php
            
            //$product_id = $_POST["senddata"];
            $product_id = 2;
            $query = "select * from product_details where product_id = '$product_id'";
            $result = mysqli_query($connect, $query);
            while($row = mysqli_fetch_array($result))
            {
        ?>
            <img src="images/<?php echo $row["product_image"]; ?>" class="img-responsive" width = "300px"/> <br>
            </div>
            <div class = "col-md-7 mb-4">
                <div class = "p-4">
                    <div class = "mb-3">
                <h3><?php echo $row["product_name"]; ?></h3>  
                    </div>
                <h4>Price - <?php echo $row["product_price"]; ?></h4> 
                <p class = "font-weight-bold"> Description </p>
                <p> <?php echo $row["description"]; ?> </p>
                <input type="hidden" name="hidden_name" id="name<?php echo $row["product_id"]; ?>" value="<?php echo $row["product_name"]; ?>" />  
                <input type="hidden" name="hidden_price" id="price<?php echo $row["product_id"]; ?>" value="<?php echo $row["product_price"]; ?>" />
                
                <input type="text" aria-label = "search" class = "form-control" style="width: 100px" name="quantity" id="quantity<?php echo $row["product_id"]; ?>" class="form-control" value="1" />
                <input type="button" name="addtocart" id="<?php echo $row["product_id"]; ?>" style="margin-top:5px; width:150px;" class="btn btn-primary btn-md my-0 p addtocart" value="Add To Cart" /> 
            </div>
            </div>
        
        </div>
    
       <div id="cart" class="tab-pane fade">  
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
   
    <div class="col-md-8">
        <h4 class="my-4 h4">Side Effects :</h4>
            <p> <?php echo $row["effects"]; ?> </p>
    </div>
    <div class="col-md-8">
        <h4 class="my-4 h4">How does <?php echo $row["product_name"]; ?> works :</h4>
            <p> <?php echo $row["working"]; ?> </p>
    </div>  
    
    <?php
      }
    ?>
   
  </div>
 </body>
</html>

<script>

$(document).ready(function(data){
    $('.addtocart').click(function(){ 
           var product_id = $(this).attr("id");  
           var product_name = $('#name'+product_id).val();  
           var product_price = $('#price'+product_id).val();  
           var product_quantity = $('#quantity'+product_id).val();  
           var action = "add";  
           if(product_quantity > 0)  
           {  
                $.ajax({  
                     url:"addtocart.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{  
                          product_id:product_id,   
                          product_name:product_name,   
                          product_price:product_price,   
                          product_quantity:product_quantity,   
                          action:action  
                     },  
                     success:function(data)  
                     {  
                        $('#order_table').html(data.order_table);  
                        $('.badge').text(data.cart_item);
                        alert("Product has been Added into Cart");  
                     }  
                });  
           }  
           else  
           {  
                alert("Please Enter Number of Quantity");
           }  
      });
    function load_data(query)
    {
        $.ajax({
           url : "search_by.php",
           method : "post",
           data : {query:query},
           success : function(data)
           {
               $('#products').html(data);
           }
        });
    }
    $('#search_text').keyup(function(){
       var search = $(this).val();
       if(search != '')
       {
           load_data(search);
       }
       else
       {
           load_data();
       }
    });
    
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