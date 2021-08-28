<?php
ob_start();
?>

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        <a href="login.php"><h2 class="active"> Se connecter</h2></a> 
        <a href="register.php"><h2 class="inactive underlineHover">S'inscrire</h2></a>
        <!-- Login Form -->
        <form method="POST" action="functions/functionLogin.php">
        <input type="text" id="username-login" name="username-login" placeholder="nom d'utilisateur" autocomplete="off" class="<?php if((isset($_GET["error"]))){ echo 'error';} ?>" >
        <input type="password" id="password-login" name="password-login" placeholder="mot de passe" autocomplete="off" class="<?php if((isset($_GET["error"]))){ echo 'error';} ?>">
        <input type="submit" class="fadeIn fourth" value="Se connecter">
        </form>
        <!-- Remind Passowrd -->
        <div id="formFooter">
        <a href="index.php"><input type="button" class="leave" value="Quitter"></a> 
        </div>
    </div>
</div>

<?php
$loginFormHTML = ob_get_clean();
?>