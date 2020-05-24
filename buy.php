<?php  
    
 include("database.php");
 session_start();  

 if(isset($_POST["place_order"]))  
 {  
           $name = mysqli_real_escape_string($connect, $_POST["name"]); 
           $no = mysqli_real_escape_string($connect, $_POST["no"]);
           $month = mysqli_real_escape_string($connect, $_POST["month"]);
           $cvv = mysqli_real_escape_string($connect, $_POST["cvv"]);
           $year = mysqli_real_escape_string($connect, $_POST["year"]);
           $query = "INSERT INTO tbl_images (customer_id,name,cardno,expmonth,cvv,expyear) VALUES ('1','$name','$no','$month','$cvv','$year')";  
           if(mysqli_query($connect, $query))  
           {  
                echo '<script>alert("Registration Done")</script>';  
           }  
           else
           {
               echo "error" . $query . mysqli_error($connect);
           }
 }  

?>  
<!DOCTYPE html>  
<html>  
    <head>
        <title>Checkout Details</title>
      </head>  
    <body>
        <?php include('Navigation.php')?>
           <br /><br />  
           <div class="container" style="width:500px;">  
                <br />  
                <div class="h2">Payment</div>
                <hr>
                <form method="post" action = "placeorder1.php">  
                     <input type="text" name="name" id="defaultContactFormName" class="form-control" placeholder="Name on Card" required/>  
                     <br />  
                     <input type="text" name="no" class="form-control" id="mvalid" placeholder="Credit Card Number" required/>  
                     <br />  
                     <input type="text" name="month" class="form-control" placeholder="Exp Month" required/>  
                     <br />
                     <input type="text" name="cvv" class="form-control" placeholder="CVV" required/>
                     <br />
                     <input type="text" name="year" class="form-control" placeholder="Exp Year" required/>  
                     <br />
                     <input type="submit" name="place_order" id = "insert" value="Checkout" class="btn btn-info mb-5" />
                     <br />  
                </form>  
           </div>
        <?php include('Footer.php')?>  
    </body>  
 </html>  
 
 <script>  
 $(document).ready(function(){  
      $('#insert').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>