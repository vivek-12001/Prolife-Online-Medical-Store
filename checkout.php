<?php 
 session_start();
 include("database.php");  
 ?> 
 
<!DOCTYPE html>  
<html>  
    <head>  
    <style> 
	body
	{
		background-color:#f1f1f1;
	}
        #box  
        {  
            width:500px;
			background-color:#ffffff;
            margin:0 auto;  
            padding:16px;  
            text-align:center;  
            margin-top:50px;
			border:1px solid #ccc;
			border-radius:5px;
        }  
    </style>  
 </head>  
 <body>  
 <?php include('Navigation.php')?>
  <div class="container">
   <div id="box">
    <h2>Payment Details</h2>
    <br />
    <form method="post" action = "orderplace.php" enctype="multipart/form-data">  
        <input type="text" name="name" pattern="[a-zA-Z\s]+" value = "vivek choudhary" class="form-control" placeholder="Name on Card" required/>  
        <br />  
        <input type="text" name="cardno" class="form-control" value = "1111222233334444" placeholder="Credit Card Number" required/>  
        <br />  
        <input type="text" name="month" class="form-control" value = "10" placeholder="Exp Month" required/>
        <br>
        <input type="text" name="year" class="form-control" value = "2022" placeholder="Exp Year" required/>
        <br />
        <input type="text" name="cvv" class="form-control" value = "578" placeholder="CVV" required/>
        <br />
        <label><h6>Upload Your Prescription</h6></label><input type="file" name="image" id="image" />  
        <br />
        <input type="submit" name="place_order" id="insert" value="Insert" class="btn btn-info m-3" />  
    </form> 
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
                alert("Upload Your Prescription...!!!");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Prescription File Format');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>