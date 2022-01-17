<?php

require_once("function.php");

if(isset($_POST['deleteAllBookings']) && !empty($_POST['deleteAllBookings'])){
    if(deletePersonalBookings($_POST['deleteAllBookings'])){
        echo "success";
    }
} else {
    echo "error";
}

?>