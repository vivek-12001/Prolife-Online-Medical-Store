<?php  
 $connect = mysqli_connect("localhost", "root", "", "prolife");  
 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM product_details WHERE product_name LIKE '%".$_POST["query"]."%'";  
      $result = mysqli_query($connect, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li>'.$row["product_name"].'</li>';  
           }  
      }  
      else  
      {  
           $output .= '<li>Country Not Found</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 }  
 if(isset($_POST["query1"]))  
 {  
      $output = '';  
	  $product_name = $_POST["query1"];
      $query = "SELECT * FROM product_details WHERE product_name = '$product_name'";  
      $result = mysqli_query($connect, $query);  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                    <div class="col-md-4 mb-3">  
                        <form method = "post" action = "Item_template.php">
                        <div class="card" style="height: 25rem; border: none;">  
                            <a href="Item_template.php"><img class="card-img-top img-responsive" src="images/'.$row["product_image"].'" alt="Card image cap" style="height: 13rem; padding: 0.5rem"></a>
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
                     </div>
                ';  
           }  
      }  
      else  
      {  
           $output = $_POST["query1"];  
      }  
      echo $output;  
 }   
 ?>  