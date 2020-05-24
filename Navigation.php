<!DOCTYPE html>
<html lang="en">
  <head>
      <title>Pro-Life</title>
	  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
      <script>
        $(document).ready(function(){
            $(this).scrollTop(0);
        });
        $(document).ready(function(){
          $("#nav-mid-cat").click(function(){
            $("#panel").slideToggle();
            $("#nav-mid-cat").css('outline-color', 'white');
          });
        });
        $(".text-light").hover(function(){
          $(".text-light").css('text-color', 'white');
        });
        $(document).ready(function(){
          $(window).scroll(function(){
            $("#panel").slideUp();
          });
        });
      </script>
      <style>
        #nav-mid-cat{
          background-color: white;
          border: none;
          font: bold 16px/20px arial, sans-serif;
          cursor: pointer;
        }
        #sec-nav{
          display: flex;
        }
        html, body, header, .view {
          height: 50%;
        }
        .dropdown{ display: inline-block;}
        .btn{margin:0;}
      </style>
  </head>
  <body>
    <header class="mb-5">
    <div id="sec-nav">
      <nav class="navbar fixed-top navbar-expand-lg blue-gradient" id="panel" style="padding-top: 6rem">
        <div class="mx-auto">
            
            <a class="cat text-white h6 mr-5" href="#" >Prescriptions</a>
            <a class="cat text-white h6 mr-5" href="#" >Family Care</a>
            <a class="cat text-white h6 mr-5" href="#" >Ayush</a>
            <a class="cat text-white h6 mr-5" href="#" >Fitness</a>
            <a class="cat text-white h6 mr-5" href="#" >Lifestyle</a>
            <a class="cat text-white h6 mr-5" href="#" >Personal Care</a>
            <a class="cat text-white h6 mr-5" href="#" >Health Library</a>
            <a class="cat text-white h6 mr-5" href="#" >Devices</a>
        </div>
      </nav>
    </div>
      <nav class="navbar fixed-top navbar-expand-lg navbar-black white pb-0 pt-0">
        <a class="navbar-brand active-cyan-4 pb-0 pt-0 mb-0 mt-0 ml-3 mr-5" href="home.php"><img src="images/icont.PNG" alt="Home" style="width:13vw"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <button class="nav-link mb-0" id="nav-mid-cat" style="font-size:2.5vh">Shop by Category <i class="fas fa-angle-down cyan-text"></i></<button>
            </li>
          </ul>
		<!--<input type="text" name="medicine_search" id="medicine_search" class="form-control mr-2" autocomplete="off" placeholder="Search for Medicine Products" aria-label="Search" style="width: 52vw">
        -->
		    <div class="container" style="width:500px;">
            <div class="input-group">
                <input type="text" name="medicine_search" id="medicine_search" class="form-control mr-2" autocomplete="off" placeholder="Search for Medicine Products" aria-label="Search" style="width: 52vw">
            </div>
	    	</div>
        <br />
		  <a href="mycart.php"><i class="fas fa-shopping-cart fa-2x mr-4 ml-5"></i></a>
          <a href="account.php"><i class="fas fa-user fa-2x mr-5"></i></a>
        </div>
      </nav>
    </header>
  </body>
</html>