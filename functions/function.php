<?php

function connectDB(){
    $servername = "localhost:8889";
    $username = "root";
    $password = "root";
    try {
        $db = new PDO("mysql:host=$servername;dbname=booking", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
}

function checkEmptyFormLogin($firstname,$password){
    if(empty($firstname) || empty($password)){
        return false;
    } else {
        return true;
    }
}

function checkEmptyFormRegister($firstname,$lastname,$username,$password){
    if(empty($firstname) || empty($lastname) || empty($username) || empty($password)){
        return false;
    } else {
        return true;
    }
}

function checkEmptyFormBooking($people,$dateCheckIn,$hourCheckIn,$dateCheckOut,$hourCheckOut){
    if(empty($people) || empty($dateCheckIn) || empty($hourCheckIn) || empty($dateCheckOut) || empty($hourCheckOut)){
        return false;
    } else {
        return true;
    }
}

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

function login($username,$password){
    $db = connectDB();
    try {
        $sql = "SELECT * FROM User WHERE username = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($username));
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                if(password_verify($password, $row["password"])){
                    session_start();
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["firstname"] = $row["firstname"];
                    $_SESSION["lastname"] = $row["lastname"];
                    $_SESSION["password"] = $row["password"];
                    $_SESSION["admin"] = $row["admin"];
                    header("Location: " . "../index.php");
                } else {
                    header("Location: " . "../login.php?error=wrongLogin");
                }
            }
        } else {
            header("Location: " . "../login.php?error=wrongLogin");
        }
        $stmt->closeCursor();
    } catch (Exception $e) {
        sleep(1);
        header("Location: " . "../register.php?error=username");
        throw new Exception("Error Processing Request" . $e->getMessage(), 1);
    }
}

function insertUser($username,$firstname,$lastname,$password){
    $db = connectDB();
    $password = password_hash($password, PASSWORD_DEFAULT);
    try {
        $sql = "INSERT INTO User (id, username, firstname, lastname, password) VALUES (NULL, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($username,$firstname,$lastname,$password));
        $stmt->closeCursor();
    } catch (Exception $e) {
        sleep(1);
        header("Location: " . "../register.php?error=sameID");
        throw new Exception("Registration error" . $e->getMessage(), 1);
    }
}

function insertBooking($idUser,$people,$dateCheckIn,$dateCheckOut,$hourCheckIn,$hourCheckOut){
    $db = connectDB();
    try {
       $sql = "INSERT INTO Appartment (id, people, date_checkin, date_checkout, hour_checkin, hour_checkout) VALUES (NULL, ?, ?, ?, ?, ?);
       SET @appartment_id = LAST_INSERT_ID();
       INSERT INTO Book (id_user,id_appartment) VALUES (?,@appartment_id);";
       $stmt = $db->prepare($sql);
       $stmt->execute(array($people,$dateCheckIn,$dateCheckOut,$hourCheckIn,$hourCheckOut,$idUser));
       $stmt->closeCursor();
    } catch (Exception $e) {
        sleep(1);
        header("Location: " . "../index.php?error=globalErrorBooking");
        throw new Exception("Registration error" . $e->getMessage(), 1);
    }
}

function deleteBooking($idAppartment){
    $db = connectDB();
    try {
       $sql = "DELETE FROM Appartment WHERE Appartment.id = ?";
       $stmt = $db->prepare($sql);
       $stmt->execute(array($idAppartment));
       $stmt->closeCursor();
       return true;
    } catch (Exception $e) {
        sleep(1);
        header("Location: " . "../index.php?error=globalErrorBooking");
        throw new Exception("Registration error" . $e->getMessage(), 1);
    }
}

function getBooking($sessionUsername){
    $db = connectDB();
    try {
       $sql = "SELECT a.id, people, date_checkin, date_checkout, hour_checkin, hour_checkout, username, firstname, lastname 
       FROM Book b 
       INNER JOIN Appartment a 
       ON b.id_appartment = a.id 
       INNER JOIN User u 
       ON b.id_user = u.id
       WHERE NOW() < a.date_checkout
       ORDER BY a.date_checkout ASC";
       $stmt = $db->query($sql);
       // Display bookings cards
       if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                $idAppartment = $row['id'];
                $people = $row['people'];
                $dateCheckIn = $row['date_checkin'];
                $dateCheckInFR = getDateFR($dateCheckIn);
                $dateCalendarCheckInFR = date("d-m-Y", strtotime($dateCheckIn));
                $dateCheckOut = $row['date_checkout'];
                $dateCheckOutFR = getDateFR($dateCheckOut);
                $dateCalendarCheckOutFR = date("d-m-Y", strtotime($dateCheckOut));
                $hourCheckIn = $row['hour_checkin'];
                $hourCheckInFR = getTimeFR($hourCheckIn);
                $hourCalendarCheckInFR = date('G:i', strtotime($hourCheckIn));
                $hourCheckOut = $row['hour_checkout'];
                $hourCheckOutFR = getTimeFR($hourCheckOut);
                $hourCalendarCheckOutFR = date('G:i', strtotime($hourCheckOut));
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $username = $row['username'];
                // Display personnal bookings cards
                if($sessionUsername != false && ($sessionUsername == $username)){
                    echo "<div class=\"booking-card\">
                    <div class=\"status\">En attente</div>
                    <div class=\"delete-booking\" data-id=\"$idAppartment\"><img src=\"assets/img/delete.svg\" alt=\"Supprimer la réservation\"/></div>
                        <div class=\"card-info-people unique-card-color\">
                            <span>$firstname $lastname</span>
                            <span>@$username</span>
                        </div>
                        <div class=\"card-info-booking\">
                            <span class=\"title-info-booking\">A réservé du :</span>
                            <div class=\"date-booking\">
                                <span class=\"date-checkin\">$dateCheckInFR</span> 
                                <span class=\"date-checkout\">$dateCheckOutFR</span>
                            </div>
                            <div class=\"date-booking\">
                                <span>$hourCheckInFR</span>
                                <span>$hourCheckOutFR</span>
                            </div>
                            <span class=\"title-info-booking\"><img src=\"assets/img/user.svg\" class=\"user-icon-card\"/>Nombre de personnes :</span>
                            <span><span class=\"unique-people-number\">$people</span></span>
                        </div>
                        <div class=\"delete-booking\" data-id=\"$idAppartment\"><img src=\"assets/img/delete.svg\" alt=\"Supprimer la réservation\"/></div>
                        <div title=\"Add to Calendar\" class=\"addeventatc custom-calendar\" data-styling=\"none\">
                            Ajouter au calendrier
                            <span class=\"start\">$dateCalendarCheckInFR $hourCalendarCheckInFR</span>
                            <span class=\"end\">$dateCalendarCheckOutFR $hourCalendarCheckOutFR</span>
                            <span class=\"timezone\">Europe/Paris</span>
                            <span class=\"title\">Réservation Appartement 669 à Lacanau Océan</span>
                            <span class=\"description\">Réservation Appartement 669, Résidence Océanide, Lacanau-Océan ($people personnes)</span>
                            <span class=\"location\">Residence Oceanides, Rés Front de Mer, 33680 Lacanau, France</span>
                        </div>
                    </div>";
                } else {
                    echo "<div class=\"booking-card\">
                    <div class=\"status\">En attente</div>
                    <div class=\"card-info-people\">
                        <span>$firstname $lastname</span>
                        <span>@$username</span>
                    </div>
                    <div class=\"card-info-booking\">
                        <span class=\"title-info-booking\">A réservé du :</span>
                        <div class=\"date-booking\">
                            <span class=\"date-checkin\">$dateCheckInFR</span> 
                            <span class=\"date-checkout\">$dateCheckOutFR</span>
                        </div>
                        <div class=\"date-booking\">
                            <span>$hourCheckInFR</span>
                            <span>$hourCheckOutFR</span>
                        </div>
                        <span class=\"title-info-booking\"><img src=\"assets/img/user.svg\" class=\"user-icon-card\"/>Nombre de personnes :</span>
                        <span><span>$people</span></span>
                        
                    </div>
                    <div title=\"Add to Calendar\" class=\"addeventatc custom-calendar\" data-styling=\"none\">
                        Ajouter au calendrier
                        <span class=\"start\">$dateCalendarCheckInFR $hourCalendarCheckInFR</span>
                        <span class=\"end\">$dateCalendarCheckOutFR $hourCalendarCheckOutFR</span>
                        <span class=\"timezone\">Europe/Paris</span>
                        <span class=\"title\">Réservation Appartement 669 à Lacanau Océan</span>
                        <span class=\"description\">Réservation Appartement 669, Résidence Océanide, Lacanau-Océan ($people personnes)</span>
                        <span class=\"location\">Residence Oceanides, Rés Front de Mer, 33680 Lacanau, France</span>
                    </div>
                </div>";
                }
            }
       } else {
           echo "<div class=\"no-booking\">
           <div>
               <img src=\"assets/img/no-booking.svg\" alt=\"Aucune réservation\" class=\"no-booking-icon\">
           </div>
           <p>Il n'y a pas de réservation pour le moment</p>
       </div>";
       }
       $stmt->closeCursor();
    } catch (Exception $e) {
        sleep(1);
        header("Location: " . "index.php?error=globalErrorDisplayBooking");
        throw new Exception("Registration error" . $e->getMessage(), 1);
    }
}

// Check if user dates are already booked
function notBooked($dateCheckIn,$dateCheckOut){
    $db = connectDB();
    try {
       $sql = "SELECT * FROM Appartment a WHERE (? BETWEEN a.date_checkin AND a.date_checkout) OR (? BETWEEN a.date_checkin AND a.date_checkout) OR (a.date_checkin > ? AND a.date_checkout < ?)";
       $stmt = $db->prepare($sql);
       $stmt->execute(array($dateCheckIn,$dateCheckOut,$dateCheckIn,$dateCheckOut));
       if($stmt->rowCount() > 0){
            $stmt->closeCursor();
            return false;
       } else {
            $stmt->closeCursor();
            return true;
       }
    } catch (Exception $e) {
        sleep(1);
        header("Location: " . "../index.php?error=sameID");
        throw new Exception("Registration error" . $e->getMessage(), 1);
    }
}

function printMessage($info){
    if(isset($info)){
        if(!empty($info)){
            switch ($info) {
                case "sameID": echo "Le nom d'utilisateur est déja pris, veuillez réessayer";
                    break;
                case "blank": echo "Sheeeesh, tous les champs ne sont pas remplis";
                    break;
                case "notConnected": echo "Connectez-vous ou inscrivez-vous pour pouvoir réserver";
                    break;
                case "valid": echo "Inscription validée, connectez-vous à présent";
                    break;
                case "wrongLogin": echo "Nom d'utilisateur ou mot de passe incorrect";
                    break;
                case "wrongAccess": echo "Vous n'avez pas les droits pour accéder à cette page";
                    break;
                case "globalErrorBooking": echo "Oops, petit problème de création de la réservation, veuillez réessayer";
                    break;
                case "globalErrorDisplayBooking": echo "Oops, problème de récupération des réservations";
                    break;
                case "formBookingNotCompleted": echo "Tous les champs n'ont pas été enregistrés";
                    break;
                case "peopleNumber": echo "Le nombre de personnes inclus dans le séjour doit être compris entre 1 et 10";
                    break;
                case "incorrectDate": echo "Les dates saisies ne sont pas valide(s)";
                    break;
                case "incorrectDateNow" : echo "La date de début du séjour doit être supérieure ou égale à la date d'aujourd'hui";
                    break;
                case "incorrectDateOld" : echo "La date de début du séjour doit être inférieure à la date de départ du séjour";
                    break;
                case "booked" : echo "Ces dates sont déja réservées, veuillez réserver d'autres dates";
                    break;
                case "bookingSuccess" : echo "Votre demande de réservation a bien été prise en compte, en attente d'approbation par un admin...";
                    break;
                default: echo "Erreur dans le formulaire";
                    break;
            }
        }
    }
}

function getDateFR($date){
    $dateFR = date("d-m-Y", strtotime($date));
    $dateFR = explode("-",$dateFR);
    $jourFR = $dateFR[0];
    $moisFR = $dateFR[1];
    $anneeFR = $dateFR[2];
    $month = [
        "01" => "Janvier",
        "02" => "Février",
        "03" => "Mars",
        "04" => "Avril",
        "05" => "Mai",
        "06" => "Juin",
        "07" => "Juillet",
        "08" => "Août",
        "09" => "Septembre",
        "10" => "Octobre",
        "11" => "Novembre",
        "12" => "Décembre"
    ];

    foreach ($month as $monthNumber => $value) {
        if($moisFR == $monthNumber){
            $moisFR = $value;
        }
    }

    return $jourFR . " " . $moisFR . " " . $anneeFR;
}

function getTimeFR($time){
    return str_replace(":","h",date('G:i', strtotime($time)));
}