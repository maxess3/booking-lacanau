<?php

require_once("function.php");

session_start();

if (isset($_SESSION["username"])) {
    getBooking($_SESSION["username"], 1);
    getBooking($_SESSION["username"], 0);
    getBooking($_SESSION["username"], 2);
} else {
    getBooking(false, 1);
    getBooking(false, 0);
    getBooking(false, 2);
}

getBooking(false, 1, true);
