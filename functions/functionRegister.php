<?php

require_once('function.php');

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email-register']) && isset($_POST['username-register']) && isset($_POST['password-register']) && isset($_POST['notification'])) {
    $firstnameRegister = $_POST['firstname'];
    $lastnameRegister = $_POST['lastname'];
    $emailRegister = $_POST['email-register'];
    $usernameRegister = $_POST['username-register'];
    $passwordRegister = $_POST['password-register'];
    $notification = $_POST['notification'];
    if (checkEmptyFormRegister($firstnameRegister, $lastnameRegister, $email, $usernameRegister, $passwordRegister)) {
        $firstnameRegister = strtoupper(substr($firstnameRegister, 0, 1)) . strtolower(substr($firstnameRegister, 1));
        $lastnameRegister = strtoupper(substr($lastnameRegister, 0, 1)) . strtolower(substr($lastnameRegister, 1));
        insertUser($usernameRegister, $firstnameRegister, $lastnameRegister, $emailRegister, $notification, $passwordRegister);
        header("Location: " . "../login.php?register=valid");
    } else {
        header("Location: " . "../register.php?error=blank");
    }
} else {
    header("Location: " . "../register.php?error=blank");
}
