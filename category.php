<?php
include('database.php');
$output = '';

$query="SELECT * FROM subsubcategory WHERE subcategory_id IN(SELECT subcategory_id FROM subcategory WHERE category_id=2)";
$result = mysqli_query($connect,$query);

?>
<html>
    <head></head>
    <body>
    <?php
      if(mysqli_num_rows($result) > 0)
	 {
		while($row = mysqli_fetch_array($result))  
		{  
           $output .= '<div class="col-md-3">  
                       <div style="border:1px solid #ccc; padding:12px; margin-bottom:12px; height:450px; width: 250px" align="center">  
                             
                            <h3>'.$row["subsubcategory_id"].'</h3>  
                            <h4>Price - '.$row["product_price"].'</h4>  
                <input type="button" name="viewdetails" style="margin-top:5px;" class="btn btn-primary" value="View Details" /> 
                       </div>
                 </div>';  
		} 
	 } 
	 else
	 {
		 $output .= 'Data Not Found';
	 }
      echo $output; 
      ?>
    </body>
</html>
    