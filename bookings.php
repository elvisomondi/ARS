<?php
    include 'db.php';
    session_start();  
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
    if(isset($_SESSION['user_name'])){
        if($_SESSION['isAdmin'] == 0){
          include 'layout/nav-in.php';
        }else{
          include 'layout/nav-Admin.php';
        }
    }else{
        include 'layout/nav-out.php';
    }
    $logged_user = $_SESSION['user_id'];
    $bookingsql = "SELECT b.flight_Id, b.booking_Id, f.depatureCity, f.arrivalCity, f.price, b.seats, f.depatureDate, f.depatureTime  FROM bookings AS b,flights_tbl AS f WHERE b.user_id = '" . $logged_user. "' AND b.isCancel = '0'";
    $bookingsresult = mysqli_query($connect, $bookingsql);
    
    if($bookingsresult){
        
        echo '<div class="container">';
        echo '<h4>Your Bookings</h4>';
        echo '<div class="row center">';
        if(mysqli_num_rows($bookingsresult) == 0){
            echo '<h4>No Bookings</h4>';
        }else{
            foreach($bookingsresult as $row){
                if(isset($row['arrivalCity'])){
                    switch ($row['arrivalCity']) {
                            case "CityA":
                                $img = 16;
                                break;
                            case "CityB":
                                $img = 2;
                                break;
                            case "CityC":
                                $img = 13;
                                break;
                            case "CityD":
                                $img = 9;
                                break;
                            case "CityE":
                                $img = 7;
                                break;
                    }
                }
                printf('<div class="col s12 m6 l4">
                            <div class="card">
                                <div class="card-image">
                                    <img src="images/%s.jpg">
                                    <span class="card-title">%s</span>
                                    <span class="card-price">%s</span>
                                    <span class="card-time">%s</span>
                                    <span class="card-seats">%s</span>
                                    <span class="card-date">%s - %s</span>
                                    
                                </div>
                            </div>
                            <form action="/ARS/bookings.php">
                                <div class="input-field col s12 m12 l12">
                                    <a href="cancelbooking.php?booking_Id=%s" class="theConfirm btn light-blue lighten-1 waves-effect waves-light col s12">Cancel</a>
                                </div>
                            </form>
                        </div>',
                        $img,
                        $row['depatureDate'],
                        $row['price'],
                        $row['depatureTime'],
                        $row['seats'],
                        $row['depatureCity'],
                        $row['arrivalCity'],
                        $row['booking_Id']
                        );
            }
        }    
        echo '</div></div>';
    }else{
       echo mysqli_errno($connect) . ":" . mysqli_error($connect);
    }
    include 'layout/footer.php';
?>

  <!--  Scripts-->
  <script src="js/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script type="text/javascript">
      var elems = document.getElementsByClassName('theConfirm');
      var confirmit = function (e){
          if (!confirm('Are You want to Cancel this Flight?')) e.preventDefault();
      };
      for (var i = 0, l = elems.length; i < l; i++){
          elems[i].addEventListener('click',confirmit,false);
      }
      
  </script>
  </body>
</html>
