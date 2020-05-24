<?php  

include("database.php");

 $output = '';  
 if(isset($_POST["sort_id"]))  
 {  
      if($_POST["sort_id"] == '1')  
      {  
           $query = "select * from product_details where subcategory_id = ".$_POST['subid']." order by product_name asc";
      }  
      else if($_POST["sort_id"] == '2')
      {  
           $query = "SELECT * FROM product_details where subcategory_id = ".$_POST['subid']." order by product_price asc"; 
      }  
      else if($_POST["sort_id"] == '3')
      {  
           $query = "SELECT * FROM product_details where subcategory_id = ".$_POST['subid']." order by product_price desc"; 
      }
	  else if($_POST["sort_id"] == '4')
      {  
           $query = "SELECT * FROM product_details where subcategory_id = ".$_POST['subid']." order by discount desc"; 
      }
	  else
	  {
		   $query = "select * from product_details where subcategory_id = ".$_POST['subid']."";
	  }
	  
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<div class="col-md-4 mb-3">  
                        <form method = "post" action = "Item_template.php">
                        <div class="card" style="height: 25rem; border: none;">  
                            <img class="card-img-top img-responsive" src="images/'.$row["product_image"].'" alt="Card image cap" style="height: 13rem; padding: 0.5rem">
                            <div class="card-body">
                                <div><h5 class="card-title" style="height: 4rem">'.$row["product_name"].'</h5></div>
                                <div style="height: 2.5rem"><p class="h5 font-weight-light">Price - '. $row["product_price"].'</p></div>
                                <input type="hidden" name="hidden_name" id="name'.$row["product_id"].'" value="'.$row["product_name"].'" />  
                                <input type="hidden" name="hidden_price" id="price'.$row["product_id"].'" value="'.$row["product_price"].'" />
                                <input type="hidden" name="senddata" id="'.$row["product_id"].'" value="'.$row["product_id"].'" />
                                <input type="submit" name="viewdetails" id="'.$row["product_id"].'" class="btn btn-primary viewdetails card text-center" value="View Details" />
                            </div>
                        </div>  
                        </form>
                     </div>';  
      }  
      echo $output;  
 }  
 
 $character = '';
 if(isset($_POST["page"]))
 {
	 $character = $_POST["page"];  
     $query = "SELECT * FROM product_details WHERE subcategory_id = ".$_POST['subid']." and product_name LIKE '$character%'";
	 $result = mysqli_query($connect, $query);  
	 if(mysqli_num_rows($result) > 0)
	 {
		while($row = mysqli_fetch_array($result))  
		{  
           $output .= '<div class="col-md-4 mb-3">
                    <form method = "post" action = "Item_template.php">
                    <!--Card-->
                    <div class="card" style="height: 25rem; border: none;">
                        <img class="card-img-top" src="images/'.$row["product_image"].'" alt="Card image cap" style="height: 13rem; padding: 0.5rem">
                        <div class="card-body">
                            <div><h5 class="card-title" style="height: 4rem">'.$row["product_name"].'</h5></div>
                            <div style="height: 2.5rem"><p class="h5 font-weight-light">Price - '.$row["product_price"].'</p></div>
                            <input type="hidden" name="hidden_name" id="name'.$row["product_id"].'" value="'.$row["product_name"].'" />  
                            <input type="hidden" name="hidden_price" id="price'.$row["product_id"].'" value="'.$row["product_price"].'" />
                            <input type="hidden" name="senddata" id="'.$row["product_id"].'" value="'.$row["product_id"].'" />
                            <input type="submit" name="viewdetails" id="'.$row["product_id"].'" class="btn btn-primary viewdetails card text-center" value="View Details" /> 
        
                        </div>
                    </div>
                    </form>
                </div>';  
		} 
	 } 
	 else
	 {
		 $output .= 'Data Not Found';
	 }
      echo $output; 
 }

?>
