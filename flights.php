<?php
    include_once('db.php');
    session_start();  

    if(isset($_SESSION['isAdmin'])){
      if($_SESSION['isAdmin'] == 0){ 
        header('location: index.php');
      }
    }else{
      header('location: index.php');
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
  <div class="" style="padding: 50px">
        <h4>Flights</h4>
    <a href="addFlight.php" class="btn light-blue lighten-1">ADD</a>
    <div>
        <table class="striped">
            <thead>
                <tr>
                    <th data-field="flight_Id">Flight Id</th>
                    <th data-field="depcity">Depature City</th>
                    <th data-field="depdate">Depature Date</th>
                    <th data-field="deptime">Depature Time</th>
                    <th data-field="arrcity">Arrival City</th>
                    <th data-field="arrdate">Arrival Date</th>
                    <th data-field="arrtime">Arrival Time</th>
                    <th data-field="arrtime">Seats</th>
                    <th data-field="price">Price</th>
                    <th data-field="isOffer">On Offer</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php
                    $getflights = "SELECT * FROM flights_tbl";
                    $allflights = mysqli_query($connect, $getflights);
                    if ($allflights){
                        foreach ($allflights as $row) {
                            printf ('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',
                                    $row['flight_Id'],
                                    $row['depatureCity'],
                                    $row['depatureDate'],
                                    $row['depatureTime'],
                                    $row['arrivalCity'],
                                    $row['arrivalDate'],
                                    $row['arrivalTime'],
                                    $row['seats'],
                                    $row['price'],
                                    $row['isOffer']);
                        }
                    }else{
                        $err="Something went wrong";
                    }
                ?> 
                </tr>
            </tbody>
        </table>
    </div>
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
