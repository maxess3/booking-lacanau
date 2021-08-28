<?php
ob_start();
?>

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

<?php
$registerFormHTML = ob_get_clean();
?>