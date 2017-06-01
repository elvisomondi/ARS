<?php
    session_start();  

    if(isset($_SESSION['isAdmin'])){
      if($_SESSION['isAdmin'] == 1){ 
        header('location: flights.php');
      } 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>ARS Airlines</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

<?php 
    if(isset($_SESSION['user_name'])){
      if($_SESSION['isAdmin'] == 0){
        include 'layout/nav-in.php';
      }else{
        include 'layout/nav-Admin.php';
      }
    }else{
        include 'layout/nav-out.php';
    }
?>
  <div class="">
    <div class="slider">
      <ul class="slides">
        <li>
          <img src="images/3.jpg"> <!-- random image -->
          <div class="caption center-align">
            <h3>ARS Airlines</h3>
            <h5 class="light grey-text text-lighten-3">Great life above.</h5>
          </div>
        </li>
        <li>
          <img src="images/2.jpg"> <!-- random image -->
          <div class="caption left-align">
            <h3>Amazing Cities </h3>
            <h5 class="light grey-text text-lighten-3">Any where you wanna go</h5>
          </div>
        </li>
        <li>
          <img src="images/service.jpg"> <!-- random image -->
          <div class="caption right-align light-blue-text">
            <h3>Great Service</h3>
            <h5 class="light light-blue-text text-lighten-3">We Care.</h5>
          </div>
        </li>
        <li>
          <img src="images/4.jpg"> <!-- random image -->
          <div class="caption center-align">
            <h3>Join Us</h3>
            <h5 class="light grey-text text-lighten-3"><a href="#" class="btn light-blue lighten-1">Sign Up</a></h5>
          </div>
        </li>
      </ul>
    </div>
  </div>


    
<?php 
    include 'layout/offers.php';
    include 'layout/footer.php';
?>

  <!--  Scripts-->
  <script src="js/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
