<?php
    include_once 'db.php';
    session_start();
    
    if(isset($_SESSION['user_name'])){
        header('location: index.php');
    }
    

    if(isset($_POST['login'])){
        $myuserName = mysqli_real_escape_string($connect,$_POST['username']);
        $mypwd = mysqli_real_escape_string($connect,$_POST['pwd']);
        
        $sql = "SELECT * FROM user_acc WHERE Username = '$myuserName' and pwd = md5('$mypwd')";
        $query = mysqli_query($connect, $sql);
        //$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
        
        $count = mysqli_num_rows($query);
        if($count == 1){
          $result = mysqli_query($connect,"SELECT * FROM user_acc WHERE Username = '$myuserName'");
            // if(isset($_POST['remember-me'])){
            //   setcookie('userName',$myuserName,time()+60*60*7);
            //   setcookie('pwd',$mypwd,time()+60*60*7);
            // }
            if ($row = mysqli_fetch_array($result)) {
              $_SESSION['user_id'] = $row['ID'];
              $_SESSION['user_name'] = $row['Username'];
              $_SESSION['name'] = $row['Name'];
              $_SESSION['isAdmin'] = $row['isAdmin'];
              if($_SESSION['isAdmin'] == 0){
                header("Location:index.php"); 
              }else{
                header("Location:flights.php");
              }
            } else {
              $err = "<strong>OOPPS!....Something went wrong .. Try Again";
            }

        }else{
            $err = "Your User Name or Password  incorrect";
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
        <title>ARS - Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <body>
        <?php 
            include 'layout/nav-out.php';
        ?>
        <div class="log-card row">
            <div class="col s12 z-depth-4 card-panel">
                <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="">
                    <div class="row">
                      <div class="input-field col s12 center">
                        <h5 class="center login-form-text">Login</h5>
                      </div>
                    </div>
                    <div class="row margin red-text">
                        <?php if(isset($err)){echo $err;}?>
                    </div>
                    <div class="row margin">
                      <div class="input-field col s12">
                        <i class="material-icons prefix">person</i>
                        <input id="username" type="text" name="username">
                        <label for="username">User Name</label>
                      </div>
                    </div>
                    <div class="row margin">
                      <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <input id="password" type="password" name="pwd">
                        <label for="password">Password</label>
                      </div>
                    </div>
                    <div class="row">          
                      <div class="input-field col s12 m12 l12">
                          <input type="checkbox" id="remember-me" name="remember-me">
                          <label for="remember-me">Remember me</label>
                      </div>
                    </div>
                    <div class="row center-align">
                      <div class="input-field col s12 m4 l3">
                          <input type="submit" value="Login" name="login" class="btn waves-effect waves-light col s12">
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6 m6 l6">
                          <p class="margin medium-small"><a href="register.php">Register Now!</a></p>
                      </div>          
                    </div>    
                </form>
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
