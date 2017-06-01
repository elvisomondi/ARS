<?php
include 'db.php';
session_start();

$searchsql = "SELECT * FROM flights_tbl WHERE flight_id = '" . $_SESSION['flight_Id']."'";
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
    if(isset($_POST['book'])){
        $seatnumber = mysqli_real_escape_string($connect,$_POST['seatnumber']);
        $bookname = mysqli_real_escape_string($connect,$_POST['bookname']);
        $address = mysqli_real_escape_string($connect,$_POST['address']);
        $city = mysqli_real_escape_string($connect,$_POST['state']);
        $state = mysqli_real_escape_string($connect,$_POST['state']);
        $contact = mysqli_real_escape_string($connect,$_POST['contact']);
        $cred = mysqli_real_escape_string($connect,$_POST['cred']);
        $userB = $_SESSION['user_id'];
        
        
            
            $booksql = "INSERT INTO bookings (flight_Id,user_Id,seats,name,address,city,state,credit_card,contact) 
                     VALUES ('{$_SESSION["flight_Id"]}','$userB','$seatnumber','$bookname','$address','$city','$state','$cred','$contact')";
            $booking = mysqli_query($connect, $booksql);
            if($booking){
                $seatreduction = "UPDATE flights_tbl SET seats = seats - '$seatnumber' WHERE flight_Id='{$_SESSION['flight_Id']}'";
                $seatRedux = mysqli_query($connect, $seatreduction);
                header("location:bookings.php");
            }else{
                echo mysqli_errno($connect) . ":" .mysqli_error($connect) .'<a href="search.php">Back</a>';
            }  
        
        
    }
    
    ?>