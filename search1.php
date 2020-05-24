<!DOCTYPE html>  
 <html>  
      <head>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <style>  
           ul{  
                background-color:#eee;  
                cursor:pointer;  
           }  
           li{  
                padding:12px;  
           }  
           </style>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:500px;">  
                <div class="input-group">
                <input type="text" id="country" style="height: 3vw" placeholder="" autocomplete="off" class="form-control input-lg" />
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary btn-sg" id="search">Get Value</button>
                    </div>
                </div>
                <br />
				<div id="countryList"></div>
           </div>  
		   <div id="product_loading"></div>
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#country').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"fetch2.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#countryList').fadeIn();  
                          $('#countryList').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', 'li', function(){  
           $('#country').val($(this).text());  
           $('#countryList').fadeOut();  
      });  
	  $('#search').click(function(){
		  var query1 = $('#country').val();
		  if(query1 != '')  
           {  
                $.ajax({  
                     url:"fetch2.php",  
                     method:"POST",  
                     data:{query1:query1},  
                     success:function(data)  
                     {  
                          $('#product_loading').html(data);  
                     }  
                });  
           } 
	  });
 });  
 </script> 