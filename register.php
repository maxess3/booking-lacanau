<?php 

require_once("functions/function.php"); 

if(isset($_POST['submit'])){
    if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email-register']) && isset($_POST['username-register']) && isset($_POST['password-register'])){
        $firstnameRegister = htmlspecialchars($_POST['firstname']);
        $lastnameRegister = htmlspecialchars($_POST['lastname']);
        $email = htmlspecialchars($_POST['email-register']);
        $usernameRegister = htmlspecialchars($_POST['username-register']);
        $passwordRegister = htmlspecialchars($_POST['password-register']);
        if(isset($_POST['notification'])){
            $notification = 1;
        } else {
            $notification = 0;
        }
        if(checkEmptyFormRegister($firstnameRegister,$lastnameRegister,$email,$usernameRegister,$passwordRegister)){
            $firstnameRegister = strtoupper(substr($firstnameRegister,0,1)) . strtolower(substr($firstnameRegister,1));
            $lastnameRegister = strtoupper(substr($lastnameRegister,0,1)) . strtolower(substr($lastnameRegister,1));
            insertUser($usernameRegister,$firstnameRegister,$lastnameRegister,$email,$notification,$passwordRegister);
            header("Location: " . "login.php?register=valid");
        }
    } else {
        $_GET["error"] = "error";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1">
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/error.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
</head>
<body>
<div style="display: none;" class="<?= isset($_GET["error"])  ? "info-message" : ""?>">
    <p><?= isset($_GET["error"]) ? printMessage($_GET["error"]) : "" ?></p>
    <img src="assets/img/error.png" alt="Message d'erreur" class="info-icon">
</div>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        <a href="login.php"><h2 class="inactive underlineHover"> Se connecter</h2></a> 
        <a href="register.php"><h2 class="active">S'inscrire</h2></a>
        <!-- Login Form -->
        <form method="POST" action="">
        <input type="text" id="firstname" name="firstname" placeholder="prénom" autocomplete="off" class="<?php if(isset($_GET["input0"]) && ($_GET["input0"] == "error")){ echo 'error'; } ?>" value="<?php if(isset($firstnameRegister)){ echo $firstnameRegister; } ?>">
        <input type="text" id="lastname" name="lastname" placeholder="nom" autocomplete="off" class="<?php if(isset($_GET["input1"]) && ($_GET["input1"] == "error")){ echo 'error'; } ?>" value="<?php if(isset($lastnameRegister)){ echo $lastnameRegister; } ?>">
        <input type="email" id="email" name="email-register" placeholder="email" autocomplete="off" class="<?php if(isset($_GET["input2"]) && ($_GET["input2"] == "error")){ echo 'error'; } ?>" value="<?php if(isset($email)){ echo $email; } ?>">
        <input type="text" id="username-register" name="username-register" placeholder="nom d'utilisateur" autocomplete="off" class="<?php if(isset($_GET["input3"]) && ($_GET["input3"] == "error")){ echo 'error'; } ?>" value="<?php if(isset($usernameRegister)){ echo $usernameRegister; } ?>">
        <input type="password" id="password-register" name="password-register" placeholder="mot de passe" autocomplete="off" class="<?php if(isset($_GET["input4"]) && ($_GET["input4"] == "error")){ echo 'error'; } ?>" value="<?php if(isset($passwordRegister)){ echo $passwordRegister; } ?>">
        <div class="notifs-group">
            <input type="checkbox" id="notification" name="notification" value="no" <?php if(isset($notification) && $notification === 1){ echo "checked"; } ?>>
            <label for="notification" style="margin-left: 10px;font-family:Poppins, sans-serif;font-size:0.9em;">Recevoir les notifications par email</label>
        </div>
        <input type="submit" value="S'inscrire" name="submit">
        </form>
        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a href="index.php"><input type="button" class="leave" value="Quitter"></a> 
        </div>
    </div>
</div>

<script src="js/error.js"></script>
</body>
</html>