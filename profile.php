<?php
    session_start();   
    
    if(!isset($_SESSION['user_name'])){
      //open modal to login 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>ARS Airlines  - Profile Page</title>

  <!-- CSS  -->
  <link href="https://fkonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

<?php 
    if(isset($_SESSION['user_id'])){
        include 'layout/nav-in.php';
    }else{
        include 'layout/nav-out.php';
    }
?>
    
<?php 
  
    include 'layout/footer.php';
?>

  <!--  Scripts-->
  <script src="js/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
