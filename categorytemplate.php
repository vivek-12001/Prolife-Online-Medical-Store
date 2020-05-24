<?php   
 include("database.php");
 $query = "SELECT * FROM product_details ORDER BY product_price desc";  
 $result = mysqli_query($connect, $query);  
 ?> 

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Category Template</title>
    <!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />-->
    <!--       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  -->
    <style>
            .slidecontainer {
                width: 100%;
            }
            .slider {
                -webkit-appearance: none;
                width: 100%;
                height: 3px;
                border-radius: 5px;
                background: #d3d3d3;
                outline: none;
                opacity: 0.7;
                -webkit-transition: .2s;
                transition: opacity .2s;
            }
            .slider:hover {
                opacity: 1;
            }
            .slider::-webkit-slider-thumb {
                -webkit-appearance: none;
                appearance: none;
                width: 15px;
                height: 15px;
                border-radius: 50%;
                background: blue;
                cursor: pointer;
            }
            .slider::-moz-range-thumb {
                width: 25px;
                height: 25px;
                border-radius: 50%;
                background: #4CAF50;
                cursor: pointer;
            }
            .btn{
                margin: 0;
            }
        </style>
    </head>
<body>
<?php include('Navigation.php')?>
<!-- Main Container -->
<div class="container mt-5 pt-3">

<div class="row pt-4">

    <!-- Sidebar -->
    <div class="col-lg-3">

        <div class="">
            
            <div class="row">
                <div class="col-md-6 col-lg-12 mb-5">
                    <h5 class="font-weight-bold dark-grey-text"><strong>Order By</strong></h3>
                        <hr width="50%" align="left">
                        <div class="divider"></div>
                        <div name="sortby" id="sortby">
                        <p class="blue-text"><button value="1"><a>Alphabetical</a></button></p>
                        <p class="dark-grey-text"><button value="2"><a>Price: low to high</a></button></p>
                        <p class="dark-grey-text"><button value="3"><a>Price: high to low</a></button></p>
                        </div>
                </div>

               
            </div>
    
            <div class="row">
                <!-- Filter by price  -->
                <div class="col-md-6 col-lg-12 mb-5">
                    <h5 class="font-weight-bold dark-grey-text"><strong>Price</strong></h3>
                    <hr width="30%" align="left">
                    <div class="slidecontainer">
                        <input type="range" min="10" max="100" step="5" value="0" class="slider" id="min_price" name="min_price">
                        <p>Value: <span id="demo"></span></p>
                    </div>
                </div>
                <!-- /Filter by price -->
            </div>
        </div>

    </div>
    <!-- /.Sidebar -->
    <div class="col-lg-9">
        <section class="section pt-4">
            <div class="row">
            <div id="product_loading">  
                <?php
                if(mysqli_num_rows($result) > 0)  
                {  
                    while($row = mysqli_fetch_array($result))  
                    {  
                ?>
                <div class="col-md-4"> 
                     <div class="card" style="height: 25rem; border: none;">
                          <img class="card-img-top img-responsive" src="images\<?php echo $row["product_image"];?>" alt="Card image cap" style="height: 13rem; padding: 0.5rem"/>  
                          <div class="card-body">
                            <div style="height: 5rem"><h5 class="card-title"><?php echo $row["product_image"];?></h5></div>
                            <div style="height: 2.5rem"><h6><p class="card-text"><?php echo $row["product_price"]; ?></p></div></h6>
                            <span class="card text-center"><a href="Item_template.php" class="btn btn-primary">View Details</a></span>
                          </div>
                     </div>  
                </div>
                <?php  
                     }  
                }  
                ?> 
            </div>
            </div>
        </section>
    </div>  
</main>
</div>
</div>
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
 <?php include('Footer.php')?>
</body>
</html>