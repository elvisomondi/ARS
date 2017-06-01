<?php
//initialize session stuff
    session_start();
    
    if(isset($_SESSION['user_name'])){
        header('location: index.php');
    }
    //initialise database
    include_once 'db.php';
//set validation error flag as false
$error = false;

    if(isset($_POST['register'])) {
        $name = mysqli_real_escape_string($connect, $_POST['name']);
        $userName = mysqli_real_escape_string($connect, $_POST['username']);
        $pwd = mysqli_real_escape_string($connect, $_POST['pwd']);
        $cpwd = mysqli_real_escape_string($connect, $_POST['cpwd']);

        //name can contain only alpha characters and space
        if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
            $error = true;
            $name_error = "Name must contain only alphabets and space";
        } elseif (strlen($pwd) < 6) {
            $error = true;
            $pwd_error = "Password must be minimum of 6 characters";
        } elseif ($pwd != $cpwd) {
            $error = true;
            $cpwd_error = "Password and Confirm Password doesn't match";
        }
        else {
            $checksql = "SELECT Username FROM user_acc where Username='$userName'";
            $checkquery = mysqli_query($connect, $checksql);
            if (mysqli_num_rows($checkquery) != 0) {
                $err = "<strong>User Name '$userName' already exixts</strong>";
            } else {
                $sql = "INSERT INTO user_acc (Name,Username,pwd) VALUES ('$name','$userName',md5('$pwd'))";
                $query = mysqli_query($connect, $sql);
                if ($query) {
                    //setup session variables
                    $result = mysqli_query($connect, "SELECT * FROM user_acc WHERE Username = '$userName'");
                    if ($row = mysqli_fetch_array($result)) {
                        $_SESSION['user_id'] = $row['ID'];
                        $_SESSION['user_name'] = $row['Username'];
                        $_SESSION['name'] = $row['Name'];
                        $_SESSION['isAdmin'] = $row['isAdmin'];
                        header("Location:index.php");
                    } else {
                        $err = "<strong>OOPPS!....Something went wrong .. Try Again";
                    }
                } else {
                    $err = "<strong>OOPPS!....Something went wrong .. Try Again";
                }
            }
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
        <title>ARS - Register</title>
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
                    <h4>Register.</h4>
                    <h6>Join Us.</h6>
                  </div>
                </div>
                <div class="row margin red-text">
                    <?php if(isset($err)){echo $err;}?>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">person</i>
                    <input id="name" name="name" type="text" placeholder="Enter Full Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
                      <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                    <label for="name">Name</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">person</i>
                    <input id="username" type="text" name="username" <input type="text" placeholder="Enter Prefered Username" required value="<?php if($error) echo $userName; ?>" class="form-control" />
                      <span class="text-danger"><?php if (isset($userName_error)) echo $userName_error; ?></span>
                    <label for="username">Username</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input id="password" type="password" name="pwd" placeholder="Password" required class="form-control" />
                      <span class="text-danger"><?php if (isset($pwd_error)) echo $pwd_error; ?></span>
                    <label for="password">Password</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input id="cpassword" type="password" name="cpwd" placeholder="Confirm Password" required class="form-control" />
                      <span class="text-danger"><?php if (isset($cpwd_error)) echo $cpwd_error; ?></span>
                    <label for="cpassword">Confirm Password</label>
                  </div>
                </div>
                <div class="row">
                  <div class="center">
                    <div class="input-field col s12 m6 l4">
                      <input type="submit" value="Register" name="register" class="btn waves-effect waves-light col s12">
                    </div>
                    <div class="input-field col s12">
                        <p class="margin center medium-small sign-up">Already have an account? <a href="login.php">Login</a></p>
                    </div>
                  </div>  
                </div>
            </form>
            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
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
