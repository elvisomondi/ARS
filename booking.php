<?php
    include 'db.php';
    session_start();
    $flight_Id = $_GET['flight_Id'];
    $_SESSION['flight_Id'] =$flight_Id;
    $searchsql = "SELECT * FROM flights_tbl WHERE flight_id = '" . $flight_Id."'";
    $flightdetails = mysqli_query($connect, $searchsql);
    if($flightdetails){
        foreach($flightdetails as $row){
            $price = $row['price'];
            $seats = $row['seats'];
            $depcity = $row['depatureCity'];
            $depdate = $row['depatureDate'];
            $deptime = $row['depatureTime'];        
            $arrcity = $row['arrivalCity'];
            $arrdate = $row['arrivalDate'];
            $arrtime = $row['arrivalTime'];
        }
    }else{
        $err= mysqli_errno($connect) . ":" .mysqli_error($connect);
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
    if($seats == 0){
        echo "<script> " ;
        echo "alert('Seats are full. Try other Flight');";
        echo "window.location='http://localhost:85/ARS/search.php';";
        echo "</script> " ; 
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
    <div class="container row" style="padding: 50px">
        <?php
             echo '<div class="col s12 m6 l6">
                            <h6>Flight No: ';
                                echo $flight_Id; 
                                echo '</h6>
                        </div>
                        <div class="col s12 m6 l6">
                            <h6>Seats: ';
                                echo $seats; 
                                echo '</h6>
                        </div>
                        <div class="col s12 m6 l6">
                            <h6>Depature City: ';
                                echo $depcity; 
                                echo '</h6>
                        </div>
                        <div class="col s12 m6 l6">
                            <h6>Arrival City: ';
                                echo $arrcity; 
                                echo '</h6>
                        </div>
                        <div class="col s12 m6 l6">
                            <h6>Depature Date: ';
                                echo $depdate; 
                                echo '</h6>
                        </div>
                        <div class="col s12 m6 l6">
                            <h6>Arrival Date: ';
                                echo $arrdate; 
                                echo '</h6>
                        </div>
                        <div class="col s12 m6 l6">
                            <h6>Depature Time: ';
                                echo $deptime; 
                                echo '</h6>
                        </div>
                        <div class="col s12 m6 l6">
                            <h6>Arrival Time:';
                                echo $arrtime; 
                                echo '</h6>
                        </div>';
             
        ?>
        <div>
           
        </div>
        <form method="post" action="confirmbooking.php" onsubmit="">
            <div class="row">
                <div class="input-field col s12 center">
                    <h5 class="center login-form-text">Enter Details</h5>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l4 m6 center">
                    <input id="seats" value="1" min="1" max="<?php echo $seats; ?>" type="number" name="seatnumber">
                    <label for="seats">Seats</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l12 m12 center">
                    <input id="name" type="text" name="bookname">
                    <label for="name">Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m12 l6 center">
                    <input id="address" type="text" name="address" required>
                    <label for="address">Address</label>
                </div>
                <div class="input-field col s12 m12 l6 center">
                    <input id="" type="text" name="city" required>
                    <label for="city">City</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m12 l6 center">
                    <input id="state" type="text" name="state" required>
                    <label for="state">State</label>
                </div>
                <div class="input-field col s12 m12 l6 center">
                    <input id="contact" type="number"  name="contact" required>
                    <label for="contact">Conatct</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m12 l12 center">
                    <input id="cred" type="text" name="cred" required>
                    <label for="cred">Credit Card</label>
                </div>
            </div>
            <div class="row center-align">
                <div class="input-field col s12 m4 l3">
                    <input type="submit" value="Book" name="book" class="btn light-blue lighten-1 waves-effect waves-light col s12">
                </div>
            </div>
             
        </form>
    </div>
   
<?php 
    include 'layout/footer.php';
?>

  <!--  Scripts-->
  <script src="js/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
