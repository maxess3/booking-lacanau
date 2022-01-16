<?php 

session_start(); 

require_once("functions/function.php");

require_once("template/searchbarBooking.php");

$today = date("Y-m-d");

if(isset($_POST["submitSettings"])){
    if(isset($_SESSION['id'])){
        if(isset($_POST['mail-notification'])){
            if($_POST['mail-notification'] === 'on'){
                updateSettings('1',$_SESSION['id']);
                $_SESSION['notification'] = '1';
            } 
        } else {
            updateSettings('0',$_SESSION['id']);
            $_SESSION['notification'] = '0';
        }
    }
}

if(isset($_POST["submitBooking"])){
    if(isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['firstname']) && isset($_SESSION['lastname']) && isset($_SESSION['password'])){
        $idUser = $_SESSION['id'];
        $username = $_SESSION['username'];
        $firstname = $_SESSION['firstname'];
        $lastname = $_SESSION['lastname'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $notification = $_SESSION['notification'];
        if(isset($_POST['people']) && isset($_POST['date-checkin']) && isset($_POST['hour-checkin']) && isset($_POST['date-checkout']) && isset($_POST['hour-checkout'])){
            $people = htmlspecialchars($_POST['people']);
            $dateCheckIn = htmlspecialchars($_POST['date-checkin']);
            $hourCheckIn = htmlspecialchars($_POST['hour-checkin']);
            $dateCheckOut = htmlspecialchars($_POST['date-checkout']);
            $hourCheckOut = htmlspecialchars($_POST['hour-checkout']);
            if(checkEmptyFormBooking($people,$dateCheckIn,$hourCheckIn,$dateCheckOut,$hourCheckOut)){
                if($people >= 1 && $people <= 10){
                    if(validateDate($dateCheckIn) && validateDate($dateCheckOut)){
                        if($dateCheckIn >= $today){
                            if($dateCheckIn < $dateCheckOut){
                                if(notBooked($dateCheckIn,$dateCheckOut)){
                                    insertBooking($idUser,$people,$dateCheckIn,$dateCheckOut,$hourCheckIn,$hourCheckOut,$username,$firstname,$lastname);
                                    if($notification === "1"){
                                        sendUserCreateBookingMail($people, $firstname, $email, $dateCheckIn, $dateCheckOut);
                                    }
                                    sendAdminCreateBookingMail($people, $username, $firstname, $lastname, $dateCheckIn, $dateCheckOut);
                                    $_GET["register"] = "bookingSuccess";
                                } else {
                                    $_GET["error"] = "booked";
                                }
                            } else {
                                $_GET["error"] = "incorrectDateOld";
                            }
                        } else {
                            $_GET["error"] = "incorrectDateNow";
                        }
                    } else {
                        $_GET["error"] = "incorrectDate";
                    }
                } else {
                    $_GET["error"] = "peopleNumber";
                }
            } else {
                $_GET["error"] = "blank";
            }
        } else {
            $_GET["error"] = "formBookingNotCompleted";
        }
    } else {
        header("Location: " . "login.php");
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1,user-scalable=0">
    <meta name="description" content="Site de réservation pour l'appartement de la résidence Océanide de Lacanau">
    <title>Lacanau | Réserver l'appartement</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/error.css">
    <link rel="stylesheet" href="css/customCalendar.css">
    <script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js" async defer></script>
</head>
<body>
<?php
    if(isset($_SESSION['notification'])){
        if($_SESSION['notification'] === '1'){
            $settings = '<div id="settings-container">
                        <form action="" id="form-settings" method="POST">
                            <span>Paramètres du compte</span>
                            <div>
                                <input type="checkbox" id="mail-notification" name="mail-notification" checked/>
                                <label for="mail-notification">Activer les notifications par email</label>
                            </div>
                        <input type="submit" value="Enregister" name="submitSettings">
                    </form>
                </div>';
        } else {
            $settings = '<div id="settings-container">
            <form action="" id="form-settings" method="POST">
                <span>Paramètres du compte</span>
                <div>
                    <input type="checkbox" id="mail-notification" name="mail-notification"/>
                    <label for="mail-notification">Activer les notifications par email</label>
                </div>
            <input type="submit" value="Enregister" name="submitSettings">
            </form>
            </div>';
        }
        echo $settings;
    }
?>
    <div id="chat-menu">
        <div id="inner-chat-menu">
            <img src="assets/img/plus-solid.svg" alt="Plus de fonctionnalité">
        </div>
        <div class="list-chat-menu">
            <ul>
                <li onclick="crate.toggle(true);" class="goToChat <?= isset($_SESSION['id']) ? '' : 'chat-list-disconnected' ?>"><img src="assets/img/discord.svg" alt="Chat en ligne" width="30" height="30" style="width:35px;">Chat en ligne</li>
                <?= isset($_SESSION['id']) ? '<li id="settings"><img src="assets/img/wrench.svg" alt="Paramètres de compte" style="width:30px;">Paramètres</li>' : ''?>
                <?= isset($_SESSION['id']) ? '<li><img src="assets/img/trash.svg" alt="Supprimer mes réservations" style="width:25px;">Supprimer toutes mes réservations</li>' : ''?>
            </ul>
        </div>
    </div>
    <div id="booking-ctn">
        <div style="display: none;" class="message-ajax">
            <p class="content-message-ajax"></p>
            <img src="assets/img/valid.png" alt="Message de succès" class="info-icon">
        </div>
        <div style="display: none;" class="<?= isset($_GET["register"]) ? "info-message-index booking-success" : ""?>">
            <p class="info-delete-success"><?php isset($_GET["register"]) ? printMessage($_GET["register"]) : ""?></p>
            <img src="assets/img/valid.png" alt="Message de succès" class="info-icon">
        </div>
        <div style="display: none;" class="<?= isset($_GET["error"]) ? "info-message-index" : ""?>">
            <p><?php isset($_GET["error"]) ? printMessage($_GET["error"]) : ""?></p>
            <img src="assets/img/error.png" alt="Message d'erreur" class="info-icon">
        </div>
        <div class="info-weather">
            <div class="info-weather-inner">
                <div class="info-weather-block">
                    <span>Température de l'air :</span>
                    <span class="info-temp-air">Loading...</span>
                </div>
                <div class="info-weather-block">
                    <span>Température de l'eau :</span>
                    <span class="info-temp-water">Loading...</span>
                </div>
                <div class="info-weather-block">
                    <span>Hauteur des vagues :</span>
                    <span class="info-swell">Loading...</span>
                </div>
                <div class="close-info-weather">
                    <img src="assets/img/times-solid.svg" alt="" style="width: 1.4em;">
                </div>
            </div>
            <div class="waves">
                <svg width="100%" height="200px" fill="none" version="1.1"
                xmlns="http://www.w3.org/2000/svg">
                <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#00B4DB" />
                    <stop offset="50%" stop-color="#224488" />
                    <stop offset="100%" stop-color="#0083B0" />
                </linearGradient>
                <path 
                    fill="url(#grad1)" 
                    d="
                    M0 67
                    C 273,183
                        822,-40
                        1920.00,106 
                    
                    V 359 
                    H 0 
                    V 67
                    Z">
                    <animate 
                    repeatCount="indefinite" 
                    fill="url(#grad1)" 
                    attributeName="d" 
                    dur="15s"
                    attributeType="XML"
                    values="
                        M0 77 
                        C 473,283
                        822,-40
                        1920,116 
                        
                        V 359 
                        H 0 
                        V 67 
                        Z; 

                        M0 77 
                        C 473,-40
                        1222,283
                        1920,136 
                        
                        V 359 
                        H 0 
                        V 67 
                        Z; 

                        M0 77 
                        C 973,260
                        1722,-53
                        1920,120 
                        
                        V 359 
                        H 0 
                        V 67 
                        Z; 

                        M0 77 
                        C 473,283
                        822,-40
                        1920,116 
                        
                        V 359 
                        H 0 
                        V 67 
                        Z
                        ">
                    </animate>
                </path>
                </svg>
            </div>
        </div>
        <main id="main-ctn" class="<?= isset($_SESSION['id']) ? "" : "main-not-connected" ?>">
            <div class="video">
                <video autoplay muted loop id="lacanau-video">
                    <source src="assets/img/sea.mp4" type="video/mp4">
                </video>
            </div>
            <div class="child-main-ctn">
                <div class="navbar-ctn">
                    <div class="logo">
                        <a href="index.php">
                            <img src="assets/logo/logo.svg" alt="Accueil réservation">
                        </a>
                        <span class="weather">
                            <img src="assets/img/cloud-sun-solid.svg" alt="Voir la méteo" style="width: 1.7em;">
                        </span>
                    </div>
                    <?php 
                        if(empty($_SESSION)){
                            echo '<div class="profile-ctn">
                                    <div class="inner-profile-ctn">
                                        <img src="assets/img/user.svg" alt="Se connecter">
                                    </div>
                                </div>';
                        } else if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                            echo '<div class="logout-ctn">
                            <div class="inner-profile-ctn">
                                <a href="admin.php"><span class="booking-manage"><img src="assets/img/pencil.svg" alt="Accueil réservation"></span></a>
                                <a href="logout.php">Se déconnecter</a>
                            </div>
                        </div>';
                        } else {
                            echo '<div class="logout-ctn">
                            <div class="inner-profile-ctn">
                                <a href="logout.php">Se déconnecter</a>
                            </div>
                        </div>';
                        }
                    ?>
                </div>
                <div class="booking-text">
                    <div class="text-info">
                        <h3>Résidence Océanide</h3>
                        <h1>Réservez votre séjour 
                        <?php if(!empty($_SESSION)){
                            echo $_SESSION['firstname'];
                        }
                        ?></h1>
                        <p>Bienvenue sur le site de réservation de l'appartement 669 à Lacanau.<br/><span class="maxime">Créé par Maxime Schellenberger</span></p>
                    </div>
                    <form action="" method="POST">
                        <?= isset($_SESSION['id']) ? $searchBarConnected : $searchBarNotConnected ?>
                    </form>
                </div>
                <div class="view-booking-ctn">
                    <div class="view-booking-inner">
                        <a href="#list-booking-ctn"><input type="button" value="Voir les réservations"></a>
                    </div>
                </div>
            </div>
        </main>
        <div id="list-booking-ctn">
            <div class="list-booking-inner">
                <?php isset($_SESSION["username"]) ? getBooking($_SESSION["username"],1) : getBooking(false,1); ?>
                <?php isset($_SESSION["username"]) ? getBooking($_SESSION["username"],0) : getBooking(false,0); ?>
                <?php isset($_SESSION["username"]) ? getBooking($_SESSION["username"],2) : getBooking(false,2); ?>
                <?php getBooking(false,1,true); ?>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/weather/weather.js"></script>
    <script src="js/chat.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@widgetbot/crate@3" async>
        const crate = new Crate({
            server: '930393641485209660',
            channel: '930393642173087786',
            defer:true,
            color: "transparent",
            glyph: ["assets/img/reset.png","200px"],
            location: ["bottom","right"]
        })
    </script>
</body>
</html>