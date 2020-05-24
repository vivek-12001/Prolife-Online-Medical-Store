<?php  

 include("database.php");
 if(isset($_POST["place_order"]))  
 {  
      $cvv = $_POST["cvv"];
      $name = $_POST["name"];
      $cardno = $_POST["cardno"];
      $month = $_POST["month"];
      $year = $_POST["year"];
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
      $query = "INSERT INTO payment_details (images,cvv,cardno,fname,month,year) VALUES ('$file','$cvv','$cardno','$name','$month','$year')";  
      mysqli_query($connect, $query); 
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>
        <title>Checkout Details</title>
      </head>  
    <body>
        <?php include("Navigation.php"); ?>
           <br /><br />  
           <div class="container" style="width:500px;">  
                <br />  
                <div class="h2">Payment</div>
                <hr>  
                <form method="post" action = "placeorder1.php" enctype="multipart/form-data">  
                     <input type="text" name="name" pattern="[a-zA-Z\s]+" id="defaultContactFormName" class="form-control" placeholder="Name on Card" required/>  
                     <br />  
                     <input type="text" name="cardno" class="form-control" id="mvalid" placeholder="Credit Card Number" required/>  
                     <br />  
                     <input type="text" name="month" class="form-control" placeholder="Exp Month" required/>
                     <br>
                     <input type="text" name="year" class="form-control" placeholder="Exp Year" required/>
                     <br />
                     <input type="text" name="cvv" class="form-control" placeholder="CVV" required/>
                     <br />
                     <input type="file" name="image" id="image" />  
                     <br />
                     <input type="submit" name="place_order" id="insert" value="Insert" class="btn btn-info m-3" />  
                </form>  
                <br />  
                </div>  
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