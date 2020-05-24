<!DOCTYPE html>
<html lang="en">
  <head>
      <title></title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
      </style>
  </head>
  <body>
    <header>
    <div id="sec-nav">
      <nav class="navbar fixed-top navbar-expand-lg blue-gradient" id="panel" style="padding-top: 6rem">
        <div class="mx-auto">
            
           <li class="dropdown"> <a class="cat text-white h6 mr-5 dropdown-toggle" data-toggle="dropdown" href="#" >Prescriptions<span class="caret"></span></a>
       <ul class="dropdown-menu " role="menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul></li>
          
          <a class="cat text-white h6 mr-5" href="#" id="ayush">Ayush</a>
          <!--<div class="ayushm">-->
          <!--  <a class="ayushi" href="#">Action</a>-->
          <!--  <a class="ayushi" href="#">Another action</a>-->
          <!--  <a class="ayushi" href="#">Something else here</a>-->
          <!--</div>-->
          <a class="cat text-white h6 mr-5" href="#" id="family">Family Care</a>
          <!--<div class="familym">-->
          <!--  <a class="familyi" href="#">Action</a>-->
          <!--  <a class="familyi" href="#">Another action</a>-->
          <!--  <a class="familyi" href="#">Something else here</a>-->
          <!--</div>-->
        
          <a class="cat text-white h6 mr-5" href="#" id="lifestyle">LifeStyle</a>
          <!--<div class="lifestylem">-->
          <!--  <a class="lifestylei" href="#">Action</a>-->
          <!--  <a class="lifestylei" href="#">Another action</a>-->
          <!--  <a class="lifestylei" href="#">Something else here</a>-->
          <!--</div>-->
          <a class="cat text-white h6 mr-5" href="#" id="personal">Personal Care</a>
          <!--<div class="personalm">-->
          <!--  <a class="personali" href="#">Action</a>-->
          <!--  <a class="personali" href="#">Another action</a>-->
          <!--  <a class="personali" href="#">Something else here</a>-->
          <!--</div>-->
          <a class="cat text-white h6 mr-5" href="#" id="library">Health Library</a>
          <!--<div class="librarym">-->
          <!--  <a class="libraryi" href="#">Action</a>-->
          <!--  <a class="libraryi" href="#">Another action</a>-->
          <!--  <a class="libraryi" href="#">Something else here</a>-->
          <!--</div>-->
          <a class="cat text-white h6 mr-5" href="#" id="devices">Devices</a>
          <!--<div class="devicesm">-->
          <!--  <a class="devicesi" href="#">Action</a>-->
          <!--  <a class="devicesi" href="#">Another action</a>-->
          <!--  <a class="devicesi" href="#">Something else here</a>-->
          <!--</div>-->
        </div>
      </nav>
    </div>
      <nav class="navbar fixed-top navbar-expand-lg navbar-black white pb-0 pt-0">
        <a class="navbar-brand active-cyan-4 pb-0 pt-0 mb-0 mt-0 ml-3 mr-5" href="Nav-Footer.php"><img src="images/icont.PNG" alt="Home"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <button class="nav-link" id="nav-mid-cat">Shop by Category <i class="fas fa-angle-down cyan-text"></i><span class="sr-only">(current)</span></<button>
            </li>
          </ul>
          <form class="form-inline active-cyan-4">
            <input class="form-control mr-2 w-400" type="text" placeholder="Search for Prescription Medicines and OTC Products..." aria-label="Search" style="width: 40rem;">
            <i class="fas fa-search mr-5" aria-hidden="true"></i>
          </form>
          <a href="#"><i class="fas fa-shopping-cart fa-2x mr-4 ml-5"></i></a>
          <a href="#"><i class="fas fa-user fa-2x mr-5"></i></a>
          </ul>
        </div>
      </nav>
    </header>
  </body>
</html>