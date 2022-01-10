<?php

function checkEmptyFormLogin($username, $password)
{
    if (empty($username) && empty($password)) {
        $_GET["error"] = "blank";
        return false;
    } else if (empty($username)) {
        $_GET["error"] = "emptyUsername";
        return false;
    } else if (empty($password)) {
        $_GET["error"] = "emptyPassword";
        return false;
    } else {
        return true;
    }
}

function checkEmptyFormRegister($firstname, $lastname, $email, $username, $password)
{
    $args = func_get_args();
    $count = 0;

    for ($i = 0; $i < count($args); $i++) {
        if (empty($args[$i])) {
            $count = $count + 1;
            $_GET["input$i"] = "error";
        }
    }

    if ($count > 0) {
        $_GET["error"] = "blank";
        return false;
    }

    return true;
}

function checkEmptyFormBooking($people, $dateCheckIn, $hourCheckIn, $dateCheckOut, $hourCheckOut)
{
    if (empty($people) || empty($dateCheckIn) || empty($hourCheckIn) || empty($dateCheckOut) || empty($hourCheckOut)) {
        return false;
    } else {
        return true;
    }
}

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}