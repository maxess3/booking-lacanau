<?php require_once("functions/function.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/error.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div style="display: none;" class="<?= isset($_GET["error"]) ? "info-message" : ""?>">
        <p><?php isset($_GET["error"]) ? printMessage($_GET["error"]) : "" ?></p>
        <img src="assets/img/error.png" alt="Message d'erreur" class="info-icon">
    </div>
    <div class="wrapper fadeInDown">
        <div id="formContent">
          <!-- Tabs Titles -->
          <a href="login.php"><h2 class="inactive underlineHover"> Se connecter</h2></a> 
          <a href="register.php"><h2 class="active">S'inscrire</h2></a>
          <!-- Login Form -->
          <form method="POST" action="functions/functionRegister.php">
            <input type="text" id="firstname" name="firstname" placeholder="prénom" autocomplete="off" class="<?php if((isset($_GET["error"]))){ echo 'error';}?>">
            <input type="text" id="lastname" name="lastname" placeholder="nom" autocomplete="off" class="<?php if((isset($_GET["error"]))){ echo 'error';}?>">
            <input type="text" id="username-register" name="username-register" placeholder="nom d'utilisateur" autocomplete="off" class="<?php if((isset($_GET["error"]))){ echo 'error';}?>">
            <input type="password" id="password-register" name="password-register" placeholder="mot de passe" autocomplete="off" class="<?php if((isset($_GET["error"]))){ echo 'error';}?>">
            <input type="submit" value="S'inscrire">
          </form>
          <!-- Remind Passowrd -->
          <div id="formFooter">
            <a href="index.php"><input type="button" class="leave" value="Quitter"></a> 
          </div>
        </div>
      </div>
</body>
</html>