<?php   
 include("database.php");
 session_start();
	if(!isset($_SESSION["username"]))
	{
		header("location : index.php");
	}
 $subcategory_id = "6";
 $query = "SELECT * FROM product_details where subcategory_id = '$subcategory_id' ORDER BY product_price desc";  
 $result = mysqli_query($connect, $query);  
 ?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Baby Care</title>
        
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
            #product_loading{
                display:flex;
                flex-direction:row;
                flex-grow:1;
                flex-wrap:wrap;
                
            }
            .az{
                display:flex;
                flex-direction:row;
                flex-grow:1;
                flex-wrap:wrap;
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
                    <h5 class="font-weight-bold dark-grey-text sortby"><strong>Order By</strong></h3>
                    <hr width="30%">
					<select name="sortby" id="sortby">  
                          <option value="0">Sort BY</option>  
                          <option value="1">Alphabetical A - Z</option>
                          <option value="2">Price : Low To High</option>
                          <option value="3">Price : High To Low</option>
						  <option value="4">Price : Discount Range</option>
                    </select>
                </div>
            </div>
    
            <div class="row">
                <!-- Filter by price  -->
                <div class="col-md-6 col-lg-12 mb-5">
                    <h5 class="font-weight-bold dark-grey-text"><strong>Price</strong></h3>
                    <hr width="30%" align="left">
                    <div class="slidecontainer">
                       <input type="range" min="1" max="100" value="0" class="slider" id="min_price" name="min_price">
                        <p><span id="price_range"></span></p>
                    </div>
                </div>
                <!-- /Filter by price -->
            </div>
			
			<div class="row">
				<div class="col-md-6 col-lg-12 mb-5">
					<h5 class="font-weight-bold dark-grey-text"><strong>Brand</strong></h3>
					<hr width="30%">
                    <div style="height: 220px; overflow-y: auto; overflow-x: hidden;">
					<?php
                    $query5 = "SELECT DISTINCT(brand_name) FROM product_details where subcategory_id = '$subcategory_id' ORDER BY product_id DESC";
                    $result5 = mysqli_query($connect,$query5);
                    while($row5 = mysqli_fetch_array($result5))
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector brand" value="<?php echo $row5['brand_name']; ?>"  >
						<?php echo $row5['brand_name']; ?></label>
                    </div>
                    <?php
                    }
                    ?>
                    </div>
				</div>
			</div>
			
        </div>

    </div>
    <!-- /.Sidebar -->

    <!-- Content -->
    <div class="col-lg-9">
	
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Home</a></li>
				<li class="breadcrumb-item"><a href="personal.php">Personal Care</a></li>
				<li class="breadcrumb-item active">Baby Care</li>
			</ol>
        
           <div class="container text-center">
                <div class="az">
                    <?php
						$character = range('A','Z');
						foreach($character as $alphabet)
						{
							echo "<span class='pagination' style='cursor:pointer; padding:0 8px 0 8px; border-width: 0 1px 0 0;border-color: grey;border-style: solid;border-radius: 0; margin: 5px 0 10px 0; font-weight: 600;' id='".$alphabet."'>".$alphabet."</span>";
						}
					?>
                </div>
            </div>
        <hr class="mr-1 ml-1">
        <!-- Products Grid -->
        <section class="section pt-4">
            
            <!-- Grid row -->
            <div id="product_loading">  
                <?php
                    while($row = mysqli_fetch_array($result))
                    {
                ?>  
               
                <div class="col-md-4 mb-3">
                    <form method = "post" action = "Item_template.php">
                    <!--Card-->
                    <div class="card" style="height: 25rem; border: none;">
                        <img class="card-img-top" src="images\<?php echo $row["product_image"];?>" alt="Card image cap" style="height: 13rem; padding: 0.5rem">
                        <div class="card-body">
                            <div><h5 class="card-title" style="height: 4rem"><?php echo $row["product_name"]; ?></h5></div>
                            <div style="height: 2.5rem"><p class="h5 font-weight-light">Price - <?php echo $row["product_price"]; ?></p></div>
                            <input type="hidden" name="hidden_name" id="name<?php echo $row["product_id"]; ?>" value="<?php echo $row["product_name"]; ?>" />  
                            <input type="hidden" name="hidden_price" id="price<?php echo $row["product_id"]; ?>" value="<?php echo $row["product_price"]; ?>" />
                            <input type="hidden" name="senddata" id="<?php echo $row["product_id"]; ?>" value="<?php echo $row["product_id"]; ?>" />
                            <input type="submit" name="viewdetails" id="<?php echo $row["product_id"]; ?>" class="btn btn-primary viewdetails card text-center" value="View Details" />       
                        </div>
                    </div>
                    <!--Card-->
                    </form>
                </div>
                <?php  
                     }  
                ?>
       
            </div>  
                <!--Grid column-->
           
            <!--Grid row-->
            <!--Grid row-->
            
            <!--Grid row-->
        </section>
        <!-- /.Products Grid -->
    </div>
    <!-- /.Content -->
</div>
</div>
<!-- /.Main Container -->
</main>
<?php include('Footer.php')?>
<script>
    $(document).ready(function(){  
		var subid = "6";
		
		$('.common_selector').click(function(){
			filter_data();
		});
		
		function filter_data()
		{
			var action = "fetch_data";
			var brand = get_filter('brand');
			$.ajax({
				url:"brand.php",
				method:"post",
				data:{action:action,subid:subid,brand:brand},
				success:function(data){
					$("#product_loading").html(data);
				}
			});
		}
		
		function get_filter(class_name)
		{
			var filter = [];
			$('.'+class_name+':checked').each(function(){
				filter.push($(this).val());
			});
			return filter;
		}
		
        $('#min_price').change(function(){  
            var price = $(this).val(); 
            $("#price_range").text("Product under Price Rs." + price);  
            $.ajax({  
                url:"load_product.php",  
                method:"POST",  
                data:{price:price,subid:subid},  
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
                data : {sort_id:sort_id,subid:subid},
                success : function(data){
                    $("#product_loading").fadeIn(500).html(data);
                }
            });
        });
        function load_data(query)
        {
            $.ajax({
               url : "search_by.php",
               method : "post",
               data : {query:query,subid:subid},
               success : function(data)
               {
                 $('#product_loading').html(data);
               }
            });
        }
        $('#medicine_search').keyup(function(){
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
        $(document).on('click', '.pagination', function(){  
           var page = $(this).attr("id");
           $(".pagination").css('color', 'black');
           $(this).css('color', 'skyblue');
           $.ajax({
            url : "sort_by.php",
            method : "post",
            data : {page:page,subid:subid},
            success : function(data){
                $('#product_loading').html(data);
            }
         });  
        });
		
    });  
    
</script>
</body>
</html>