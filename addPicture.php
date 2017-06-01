<?php
    include 'db.php';
    session_start();
    $user_Id = $_SESSION['user_id'];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>ARS Airlines  - Profile Page</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

<?php 
    if(isset($_SESSION['isAdmin'])){
      if($_SESSION['isAdmin'] == 1){ 
        header('location: flights.php');
      } 
    }else{
        //alert to login to book
        if(!isset($_SESSION['user_id'])){
           echo "<script> " ;
           echo "alert('Not logged in. Log in to continue');";
           echo "window.location='http://localhost:85/ARS/login.php';";
           echo "</script> " ;
        }
    }
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
    <div clas="container">
        <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <input type="file" name="img">
            <input type="submit" name="submit">
        </form>
        
    </div>
<?php 
    if(isset($_POST['submit'])){
        $folder = "/images/dp/";
        move_uploaded_file($_FILES[" img "][" tmpname "],"$folder"."$user_Id");
    }
    include 'layout/footer.php';
?>

  <!--  Scripts-->
  <script src="js/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
