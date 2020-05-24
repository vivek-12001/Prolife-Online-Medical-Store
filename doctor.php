<?php

session_start();
include("database.php");
if(!isset($_SESSION["username"]))
{
	header("location : index.php");
}

$query = "select distinct speciality from doctor order by speciality asec";
$result = mysqli_query($connect,$query);

?>

<html>

<head>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
	
	<title>SEARCH DOCTOR</title>

</head>
<body>

<header>

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark pink scrolling-navbar">
        <a class="navbar-brand" href="home.php"><strong>Prolife</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
				<li class="nav-item">
                    <a class="nav-link" href="account.php">EDIT PROFILE </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order.php">MANAGE ORDERS</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="mycart.php">CART</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="doctor.php">SEARCH DOCTOR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="livechat.php">LIVE CHAT WITH DOCTOR</a>
                </li>
            </ul>
            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">LOGOUT</a>
                </li>
            </ul>
        </div>
    </nav>

</header>

<main>
    <div class="container">
		<div id="search_area" style="margin-top: 10%;">
			<input type="text" name="doctor_search" id="doctor_search" class="form-control input-lg" autocomplete="off" placeholder="Search by speciality.." />
		</div>
		<br><br>
		<div id="doctor_data"></div>
    </div>
</main>

<?php include('footer1.php')?>

</body>
</html>

<script>
$(document).ready(function(){
 
 load_data('');
 
 function load_data(query, typehead_search = 'yes')
 {
  $.ajax({
   url:"fetch_doctor.php",
   method:"POST",
   data:{query:query, typehead_search:typehead_search},
   success:function(data)
   {
    $('#doctor_data').html(data);
   }
  });
 }
 
 $('#doctor_search').typeahead({
  source: function(query, result){
   $.ajax({
    url:"fetch_doctor.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data){
     result($.map(data, function(item){
      return item;
     }));
     load_data(query, 'yes');
    }
   });
  }
 });
 
 $(document).on('click', 'li', function(){
  var query = $(this).text();
  load_data(query);
 });
 
	$(document).on('click','.book',function(){
       var doctor_id = $(this).attr("id");
       if(confirm("Are you sure you want to book the appointment...???"))
       {
           $.ajax({
              url : "book.php",
              method : "post",
              data : {doctor_id : doctor_id},
              success:function(data)
              {
                  $('#doctor_data').html(data);
				  alert("Your Doctor Appointment has been booked successfully...!!!");
				  location.reload();
              }
           });
       }
       else
       {
           return false;
       }
    });
 
});
</script>