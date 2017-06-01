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
    <div style="padding: 50px">
        <h4>Cancellations</h4>
        <table class="striped">
            <thead>
                <tr>
                    <th data-field="flight_Id">Flight ID</th>
                    <th data-field="User">User ID</th>
                    <th data-field="Name">Name</th>
                    <th data-field="Seats">Seats</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php
                    $getcancels = "SELECT * FROM bookings where isCancel = 1";
                    $allcancels = mysqli_query($connect, $getcancels);
                    if ($allcancels){
                        foreach ($allcancels as $row) {
                            printf ('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',
                                    $row['flight_Id'],
                                    $row['user_Id'],
                                    $row['name'],
                                    $row['seats']
                                    );
                        }
                    }else{
                        $err="Something went wrong";
                    }
                ?> 
                </tr>
            </tbody>
        </table>
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
