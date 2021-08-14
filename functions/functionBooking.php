<?php

require_once("function.php");

session_start();

$today = date("Y-m-d");

if(isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['firstname']) && isset($_SESSION['lastname']) && isset($_SESSION['password'])){
    $idUser = $_SESSION['id'];
    $username = $_SESSION['username'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $password = $_SESSION['password'];
    if(isset($_POST['people']) && isset($_POST['date-checkin']) && isset($_POST['hour-checkin']) && isset($_POST['date-checkout']) && isset($_POST['hour-checkout'])){
        $people = $_POST['people'];
        $dateCheckIn = $_POST['date-checkin'];
        $hourCheckIn = $_POST['hour-checkin'];
        $dateCheckOut = $_POST['date-checkout'];
        $hourCheckOut = $_POST['hour-checkout'];
        if(checkEmptyFormBooking($people,$dateCheckIn,$hourCheckIn,$dateCheckOut,$hourCheckOut)){
            if($people >= 1 && $people <= 10){
                if(validateDate($dateCheckIn) && validateDate($dateCheckOut)){
                    if($dateCheckIn >= $today){
                        if($dateCheckIn < $dateCheckOut){
                            if(notBooked($dateCheckIn,$dateCheckOut)){
                                insertBooking($idUser,$people,$dateCheckIn,$dateCheckOut,$hourCheckIn,$hourCheckOut);
                                header("Location: " . "../index.php?register=bookingSuccess");
                            } else {
                                header("Location: " . "../index.php?error=booked");
                            }
                        } else {
                            header("Location: " . "../index.php?error=incorrectDateOld");
                        }
                    } else {
                        header("Location: " . "../index.php?error=incorrectDateNow");
                    }
                } else {
                    header("Location: " . "../index.php?error=incorrectDate");
                }
            } else {
                header("Location: " . "../index.php?error=peopleNumber");
            }
        } else {
            header("Location: " . "../index.php?error=blank");
        }
    } else {
        header("Location: " . "../index.php?error=formBookingNotCompleted");
    }
} else {
    header("Location: " . "../login.php?error=notConnected");
}


