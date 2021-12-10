<?php

require_once('function.php');

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username-register']) && isset($_POST['password-register'])) {
    $firstnameRegister = $_POST['firstname'];
    $lastnameRegister = $_POST['lastname'];
    $usernameRegister = $_POST['username-register'];
    $passwordRegister = $_POST['password-register'];
    if (checkEmptyFormRegister($firstnameRegister, $lastnameRegister, $usernameRegister, $passwordRegister)) {
        $firstnameRegister = strtoupper(substr($firstnameRegister, 0, 1)) . strtolower(substr($firstnameRegister, 1));
        $lastnameRegister = strtoupper(substr($lastnameRegister, 0, 1)) . strtolower(substr($lastnameRegister, 1));
        insertUser($usernameRegister, $firstnameRegister, $lastnameRegister, $passwordRegister);
        header("Location: " . "../login.php?register=valid");
    } else {
        header("Location: " . "../register.php?error=blank");
        $firstnameRegister = "iji";
    }
} else {
    header("Location: " . "../register.php?error=blank");
}
