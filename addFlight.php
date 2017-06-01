<?php
    include 'db.php';
    session_start();  

    if(isset($_SESSION['isAdmin'])){
      if($_SESSION['isAdmin'] == 0){ 
        header('location: index.php');
      }
    }else{
      header('location: index.php');
    }

    if(isset($_POST['addFlight'])){
      $depcity = mysqli_real_escape_string($connect,$_POST['depcity']);
      $arrcity = mysqli_real_escape_string($connect,$_POST['arrcity']);
      $price = mysqli_real_escape_string($connect,$_POST['price']);
      $depdate = mysqli_real_escape_string($connect,$_POST['depdate']);
      $deptime = mysqli_real_escape_string($connect,$_POST['deptime']);
      $arrtime = mysqli_real_escape_string($connect,$_POST['arrtime']);
      $arrdate = mysqli_real_escape_string($connect,$_POST['arrdate']);

      if(isset($_POST['isOffer'])){
        $isOffer = 1;
      }else{
        $isOffer = 0;
      }
      $flightsql = "INSERT INTO flights_tbl (depatureCity,depatureDate,depatureTime,arrivalCity,arrivalDate,arrivalTime,price,isOffer)
       VALUES ('$depcity','$depdate','$deptime','$arrcity','$arrdate','$arrtime','$price','$isOffer')" ;
      

      $flightquery = mysqli_query($connect, $flightsql);
      if($flightquery){
        header('location: flights.php');
      }
      else {
        $err =  mysqli_errno($connect) . ":" . mysqli_error($connect);
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
    <div class="container row" style="padding: 50px">
        <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="">
          <div class="row margin">
            <h4>Add Flights</h4>
          </div> 
          <div class="row margin red-text">
            <?php if(isset($err)){echo $err;}?>
          </div>            
            <div class="input-field col s12 m6 l6">
                <select id="depature" class="icons" name="depcity" onChange="changePrice()" required>
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
                <select id="arrival" class="icons" name="arrcity" onChange="changePrice()" required>
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
                <input id="price" type="number" placeholder="Price" name="price" >
                <label>Price</label>
            </div>
            <div class="input-field col s12 m6 l6">
                <label>Depature Date</label><br>
                <input type="date"  id="depdate" placeholder="Date" name="depdate" >
            </div>
            <div class="input-field col s12 m6 l6">
                <label>Arrival Date</label><br>
                <input type="date"  placeholder="Date" name="arrdate" >
            </div>
            <div class="input-field col s12 m6 l6">
                <label>Depature Time</label><br>
                <input type="time" name="deptime">
            </div>
            
            <div class="input-field col s12 m6 l6">
                <label>Arrival Time</label><br>
                <input type="time" name="arrtime">
            </div>
            <div class="input-field col s12 m12 l12">
              <input type="checkbox" id="isOffer" name="isOffer">
              <label for="isOffer">Offer</label>
            </div>
            <div class="input-field col s12 m4 l3">
                <input type="submit" value="Add Flight" name="addFlight" class="btn light-blue lighten-1 waves-effect waves-light col s12">
            </div>  
        </form>
      </div>  
  <?php 
      
      include 'layout/footer.php';
  ?>

  <!--  Scripts-->
  <script src="js/price.js"></script>
  <script src="js/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
