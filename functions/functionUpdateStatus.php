<?php

require_once("function.php");

if(isset($_POST['status']) && isset($_POST['idAppt']) && !empty($_POST['idAppt'])){
    updateStatusBooking($_POST['status'],$_POST['idAppt']);
    echo "good";
} else {
    echo "oops";
}

?>