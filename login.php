<?php 
require_once("functions/function.php"); 
require_once("vue/login.php");
?>
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
    <div style="display: none;" class="<?= isset($_GET["register"]) ? "info-message" : ""?>">
      <p><?php isset($_GET["register"]) ? printMessage($_GET["register"]) : "" ?></p>
      <img src="assets/img/valid.png" alt="Message d'erreur" class="info-icon">
    </div>
    <div style="display: none;" class="<?= isset($_GET["error"]) ? "info-message" : ""?>">
      <p><?php isset($_GET["error"]) ? printMessage($_GET["error"]) : "" ?></p>
      <img src="assets/img/error.png" alt="Message d'erreur" class="info-icon">
    </div>
    <?= $loginFormHTML ?>
</body>
</html>