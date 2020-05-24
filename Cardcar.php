<?php
include("database.php");
?>

<html>
 <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <style>
        .card:hover{
            box-shadow: 0 0 0.5rem rgb(214, 214, 214);
        }
    </style>
 </head>
 <body>
  <div class="container">
     
   <br />
   <div class="form-group">
    <div class="input-group">
     <input type="text" name="search_text" id="search_text" placeholder="Search by Product Name" class="form-control" />
     <span class="input-group-addon">Search</span>
	</div>
   </div>
   <br />
   <div class = "container" id = "result">
        <ul class="nav nav-tabs">  
            <li class="active"><a data-toggle="tab" href="#products">Product</a></li>  
            <li><a data-toggle="tab" href="#cart">Cart <span class="badge"> </span></a></li>  
        </ul>
        <div class = "tab-content">
            <div id = "products" class = "tab-pane fade in active">
        <?php
            $query = "select * from product_details";
            $result = mysqli_query($connect, $query);
            while($row = mysqli_fetch_array($result))
            {
        ?>
        <div class="col-md-3">  
            <form method = "post" action = "viewdetails1.php">
            <div style="border:1px solid #ccc; padding:12px; margin-bottom:12px; height:450px; width: 250px" align="center">  
                <img src="images/<?php echo $row["product_image"]; ?>" class="img-responsive" /> <br>
                <h3><?php echo $row["product_name"]; ?></h3>  
                <h4>Price - <?php echo $row["product_price"]; ?></h4>  
                <input type="hidden" name="hidden_name" id="name<?php echo $row["product_id"]; ?>" value="<?php echo $row["product_name"]; ?>" />  
                <input type="hidden" name="hidden_price" id="price<?php echo $row["product_id"]; ?>" value="<?php echo $row["product_price"]; ?>" />
                <input type="hidden" name="senddata" id="<?php echo $row["product_id"]; ?>" value="<?php echo $row["product_id"]; ?>" />
                <input type="submit" name="viewdetails" id="<?php echo $row["product_id"]; ?>" style="margin-top:5px;" class="btn btn-primary viewdetails" value="View Details" /> 
            </div>
            </form>
        </div>
        <?php
            }
        ?>
        
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
  </div>
 </body>
</html>

<script>

$(document).ready(function(){
    
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
    
    
    
});

</script>