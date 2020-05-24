<?php   
 include("database.php");
 $query = "SELECT * FROM product_details ORDER BY product_price desc";  
 $result = mysqli_query($connect, $query);  
 ?> 

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Category Template</title>
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    </head>
<body>

<!-- Main Container -->
            <div class="container" style="width:1000px;">  
                <br />  
                <br />  
                <div align="center">  
                     <input type="range" min="10" max="100" step="5" value="50" id="min_price" name="min_price" />  
                     <span id="price_range"></span>  
                     <br> <br> 
                     <select name="sortby" id="sortby">  
                          <option value="0">Sort BY</option>  
                          <option value="1">Alphabetical A - Z</option>
                          <option value="2">Price : Low To High</option>
                          <option value="3">Price : High To Low</option>
                     </select>
                </div>  
                <br /> 
                <div id="product_loading">  
                <?php  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>  
                <div class="col-md-3">  
                     <div style="border:1px solid #ccc; padding:12px; margin-bottom:16px; height:375px;" align="center">  
                          <img src="images\<?php echo $row["product_image"];?>" class="img-responsive" />  
                          <h3><?php echo $row["product_name"]; ?></h3>  
                          <h4>Price - <?php echo $row["product_price"]; ?></h4>  
                     </div>  
                </div>  
                <?php  
                     }  
                }  
                ?>  
                </div>  
            </div>  
<!-- /.Main Container -->
</main>

</body>
</html>

<script>  
 $(document).ready(function(){  
      $('#min_price').change(function(){  
           var price = $(this).val();  
           $("#price_range").text("Product under Price Rs." + price);  
           $.ajax({  
                url:"load_product.php",  
                method:"POST",  
                data:{price:price},  
                success:function(data){  
                     $("#product_loading").fadeIn(500).html(data);  
                }  
           });  
      });  
      $('#sortby').change(function(){
         var sort_id = $(this).val();
         $.ajax({
            url : "sort_by.php",
            method : "post",
            data : {sort_id : sort_id},
            success : function(data){
                $("#product_loading").fadeIn(500).html(data);
            }
         });
     });
 });  
 </script>