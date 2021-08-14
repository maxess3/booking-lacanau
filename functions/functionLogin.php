<?php

require_once('function.php');

if(isset($_POST['username-login']) && isset($_POST['password-login'])){
    $usernameLogin = $_POST['username-login'];
    $passwordLogin = $_POST['password-login'];
        if(checkEmptyFormLogin($usernameLogin,$passwordLogin)){
            login($usernameLogin,$passwordLogin);
        } else {
            sleep(1);
            header("Location: " . "../login.php?error=blank");
        }
} else {
    sleep(1);
    header("Location: " . "../register.php");
}