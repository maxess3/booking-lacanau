<?php

require_once("function.php");

if(isset($_POST['deleteBooking']) && !empty($_POST['deleteBooking'])){
    if(deleteBooking($_POST['deleteBooking'])){
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}

?>