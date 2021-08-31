<?php 

require_once("functions/function.php");
 
session_start(); 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site de réservation pour l'appartement de la résidence Océanide de Lacanau">
    <title>Lacanau | Réserver l'appartement</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/error.css">
    <link rel="stylesheet" href="css/customCalendar.css">
    <script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js" async defer></script>
</head>
<body>
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
        <main id="main-ctn">
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
                        <h3>Résidence Océanide 28°</h3>
                        <h1>Réservez votre séjour 
                        <?php if(!empty($_SESSION)){
                            echo $_SESSION['firstname'];
                        }
                        ?></h1>
                        <p>Bienvenue sur le site de réservation de l'appartement 669 à Lacanau.<br/><span class="maxime">Créé par Maxime Schellenberger</span></p>
                    </div>
                    <form action="functions/functionBooking.php" method="POST">
                        <div class="inner-form">
                            <div>           
                                <label for="people">Personne(s) :</label>
                                <input type="number" min="1" max="10" id="people" name="people" value="1">
                            </div>     
                            <div>
                                <label for="date-checkin">Jour d'arrivée :</label>
                                <input type="date" id="date-checkin" name="date-checkin" value="<?= date('Y-m-d') ?>">
                            </div>
                            <div>
                                <label for="hour-checkin">Heure d'arrivée :</label>
                                <input type="time" id="hour-checkin" name="hour-checkin" value="12:00">
                            </div>
                            <div>
                                <label for="date-checkout">Jour de départ :</label>
                                <input type="date" id="date-checkout" name="date-checkout">
                            </div>
                            <div>           
                                <label for="hour-checkout">Heure du départ :</label>
                                <input type="time" id="hour-checkout" name="hour-checkout" value="12:00">
                            </div>
                            <div class="btn-booking">           
                                <button type="submit" id="submit-booking" value="Réserver">Réserver</button>
                            </div>
                        </div>
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
                <div class="info-booking-status status-green"><span>Réservations approuvées :</span></div>
                <?php isset($_SESSION["username"]) ? getBooking($_SESSION["username"],1) : getBooking(false,1); ?>
                <div class="info-booking-status status-orange" id="pending-list"><span>Réservations mises en attente :</span></div>
                <?php isset($_SESSION["username"]) ? getBooking($_SESSION["username"],0) : getBooking(false,0); ?>
                <div class="info-booking-status status-red"><span>Réservations annulées :</span></div>
                <?php isset($_SESSION["username"]) ? getBooking($_SESSION["username"],2) : getBooking(false,2); ?>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>