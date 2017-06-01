<?php
    include_once 'db.php';
    session_start();  

    if(isset($_SESSION['isAdmin'])){
      if($_SESSION['isAdmin'] == 1){ 
        header('location: flights.php');
      } 
    }
    
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>ARS - Booking</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div class="container row" style="padding: 50px">
        <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <div class="input-field col s12 m6 l6">
                <select class="icons" name="depcity">
                    <option value="" disabled selected>Depature City</option>
                    <option value="CityA" data-icon="images/1.jpg" class="circle">CityA</option>
                    <option value="CityB" data-icon="images/2.jpg" class="circle">CityB</option>
                    <option value="CityC" data-icon="images/3.jpg" class="circle">CityC</option>
                    <option value="CityD" data-icon="images/4.jpg" class="circle">CityD</option>
                    <option value="CityE" data-icon="images/5.jpg" class="circle">CityE</option>
                </select>
                <label>Depature City</label>
            </div>
            <div class="input-field col s12 m6 l6">
                <select class="icons" name="arrcity">
                    <option value="" disabled selected>Arrival City</option>
                    <option value="CityA" data-icon="images/1.jpg" class="circle">CityA</option>
                    <option value="CityB" data-icon="images/2.jpg" class="circle">CityB</option>
                    <option value="CityC" data-icon="images/3.jpg" class="circle">CityC</option>
                    <option value="CityD" data-icon="images/4.jpg" class="circle">CityD</option>
                    <option value="CityE" data-icon="images/5.jpg" class="circle">CityE</option>
                </select>
                <label>Arrival City</label>
            </div>
            <div class="input-field col s12 m12 l12">
                <label>Depature Date</label><br>
                <input type="date" name="date" placeholder="Date">  
            </div>
            <br>
            <div class="input-field col s12 m4 l3">
                <input type="submit" value="Search Flight" name="searchFlight" class="btn light-blue lighten-1 waves-effect waves-light col s12">
            </div>
        </form>
    </div>
    <div class="row container center">
        <?php
        if(isset($_POST['searchFlight'])){
            $depcity = mysqli_real_escape_string($connect,$_POST['depcity']);
            $arrcity = mysqli_real_escape_string($connect,$_POST['arrcity']);
            $date = mysqli_real_escape_string($connect,$_POST['date']);
            $search = "SELECT * FROM flights_tbl WHERE depatureCity = '" . $depcity. "' and arrivalCity = '" . $arrcity. "' and depatureDate = '" . $date. "'";
            $searchresult = mysqli_query($connect, $search);
            
            if($searchresult){
                if(mysqli_num_rows($searchresult) == 0){
                    echo '<h4>No Flights</h4>';
                }else{
                    foreach ($searchresult as $row) {
                        if(isset($arrcity)){
                            switch ($arrcity) {
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
                    printf(
                                '<div class="col s12 m6 l4">
                                    <a href="booking.php?flight_Id=%s" class="card">
                                        <div class="card-image">
                                            <img src="images/%s.jpg">
                                            <span class="card-title">%s - %s</span>
                                            <span class="card-price">%s</span>
                                            <span class="card-time">%s</span>
                                            <span class="card-seats">%s</span>
                                            <span class="card-date">%s</span>
                                        </div>
                                    </a>
                                </div>',
                                $row["flight_Id"],
                                $img,
                                $row["depatureCity"],
                                $row["arrivalCity"],
                                $row["price"],
                                $row["depatureTime"],
                                $row["seats"],
                                $row["depatureDate"]
                            );   
                    }
                }    
            }else{
                echo mysqli_errno($connect) . ":" . mysqli_error($connect);
            }
            
            
        }

        ?>
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
