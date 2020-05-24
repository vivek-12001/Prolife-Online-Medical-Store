<?php 
include("database.php");
?>
 <!DOCTYPE html>  
 <html>  
      <head>
          <title>Prescriptions</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
           <style>
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
           <br />
           <hr style="margin: 0 0 10px 13vw" width="78%">
           <div class="container text-center" style="margin: 0 0 10px 17vw">
                <div class="az">
                    <?php
						$character = range('A','Z');
						foreach($character as $alphabet)
						{
							echo "<span class='pagination' style='cursor:pointer; padding:0 10px 0 10px; border-width: 0 1px 0 0;border-color: grey;border-style: solid;border-radius: 0; margin: 5px 0 10px 0; font-weight: 600;' id='".$alphabet."'>".$alphabet."</span>";
						}
					?>
                </div>
            </div>
                <hr style="margin: 0 0 10px 13vw" width="78%">
                     <div align="center">
                     <select name="sortby" id="sortby">  
                          <option value="0">Sort BY</option>  
                          <option value="1">Alphabetical A - Z</option>
                          <option value="2">Price : Low To High</option>
                          <option value="3">Price : High To Low</option>
                     </select> 
                     </div>
                     <br><br>

                </div>  
           </div>

    </div>
    <div id="product_loading">  
                <?php
                    $query = "select * from product_details order by product_name asc";
                    $result = mysqli_query($connect, $query);
                    while($row = mysqli_fetch_array($result))
                    {
                ?>  
               
                <div class="col-3 mb-4">
                    <form method = "post" action = "Item_template.php">
                    <!--Card-->
                    <div class="card" style="height: 25rem; border: none;">
                        <a href="Item_template.php"><img class="card-img-top" src="images\<?php echo $row["product_image"];?>" alt="Card image cap" style="height: 13rem; padding: 0.5rem"></a>
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
            <?php include('Footer.php')?>
    </body>  
</html>  
 <script>
 $(document).ready(function(){
     $('#sortby').change(function(){
         var sort_id = $(this).val();
         $.ajax({
            url : "sort_by.php",
            method : "post",
            data : {sort_id : sort_id},
            success : function(data){
                $('#product_loading').html(data);
            }
         });
     });
     $(document).on('click', '.pagination', function(){  
           var page = $(this).attr("id");
           $(".pagination").css('color', 'black');
           $(this).css('color', 'skyblue');
           $.ajax({
            url : "sort_by.php",
            method : "post",
            data : {page : page},
            success : function(data){
                $('#product_loading').html(data);
            }
         });  
      });
 });
 $("#ALL").on('click', function() {
  window.location = "alphabeticdisplay.php";
});
 </script>