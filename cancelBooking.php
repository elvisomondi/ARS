<?php
    include 'db.php';
    session_start();
    $booking_Id = $_GET['booking_Id'];
    $cancelsql = "UPDATE bookings SET isCancel = 1 WHERE booking_Id='$booking_Id'";
    $cancel = mysqli_query($connect, $cancelsql);
    if($cancel){
        header('location:bookings.php');
    }else{
        echo mysqli_errno($connect) . ":" . mysqli_error($connect);
    }
?>