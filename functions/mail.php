<?php

function sendAdminCreateBookingMail($people, $username, $firstname, $lastname, $dateCheckIn, $dateCheckOut)
{
    $dateCheckIn = getDateFR($dateCheckIn);
    $dateCheckOut = getDateFR($dateCheckOut);
    $to = "titanlost31@gmail.com";
    $subject = "⚠️ Lacanau : Demande de réservation de $firstname $lastname en attente, $dateCheckIn - $dateCheckOut";
    $message = "<!DOCTYPE html>
    <html lang=\"fr\">
    <head>
        <meta charset=\"UTF-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    </head>
    <body>
        <p><span style=\"font-weight:bold;\">Réservation en attente de :</span> $firstname $lastname <span style=\"color: red;\">(@$username)</span></p>
        <p><span style=\"font-weight:bold;\">Réservation pour :</span> $people personne(s)</p>
        <p><span style=\"font-weight:bold;\">Date de début du séjour :</span> $dateCheckIn</p>
        <p><span style=\"font-weight:bold;\">Date de départ du séjour :</span> $dateCheckOut</p>
        <a href=\"https://lacshelter.com/admin.php\"><button style=\"-webkit-appearance: none;border: 0;padding: 15px 40px;border-radius: 100px;background-color: #0083bb;cursor: pointer !important;color: white;font-weight: bold;font-size: 1.2em;\"</button>Voir la réservation</a>
    </body>
    </html>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <Reservation@no-reply.com>' . "\r\n";
    return mail($to, $subject, $message, $headers);
}

function sendUserCreateBookingMail($people, $firstname, $email, $dateCheckIn, $dateCheckOut)
{
    $dateCheckIn = getDateFR($dateCheckIn);
    $dateCheckOut = getDateFR($dateCheckOut);
    $to = "$email";
    $subject = "🏄‍♂️ $firstname, votre réservation pour l'appartement 669 ($dateCheckIn - $dateCheckOut) a bien été prise en compte ...";
    $message = "<!DOCTYPE html>
    <html lang=\"fr\">
    <head>
        <meta charset=\"UTF-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    </head>
    <body>
        <p>Votre demande de réservation a bien été prise en compte 🏄‍♂️ </p>
        <p><span style=\"font-weight:bold;\">Réservation pour :</span> $people personne(s)</p>
        <p><span style=\"font-weight:bold;\">Date de début du séjour :</span> $dateCheckIn</p>
        <p><span style=\"font-weight:bold;\">Date de départ du séjour :</span> $dateCheckOut</p>
        <p>Un administrateur va bientôt étudier votre demande de réservation <span style=\"font-weight:bold;\">(Délai de réponse : 24h à 48h)</span></p>
        <a href=\"https://lacshelter.com/\"><button style=\"-webkit-appearance: none;border: 0;padding: 15px 40px;border-radius: 100px;background-color: #0083bb;cursor: pointer !important;color: white;font-weight: bold;font-size: 1.2em;\"</button>Voir la réservation</a>
    </body>
    </html>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <Reservation@no-reply.com>' . "\r\n";
    return mail($to, $subject, $message, $headers);
}

function sendUserUpdateBookingMail($people, $username, $firstname, $lastname, $dateCheckIn, $dateCheckOut, $email, $status, $firstnameAdmin)
{
    if($status === "0"){
        $infoStatus = "a été mise en attente";
    } else if($status === "1"){
        $infoStatus = "a été approuvé";
    } else if($status === "2") {
        $infoStatus = "a été annulé";
    }
    $dateCheckIn = getDateFR($dateCheckIn);
    $dateCheckOut = getDateFR($dateCheckOut);
    $to = "$email";
    $subject = "🏄‍♂️ $firstname $lastname ($username), votre séjour à Lacanau $infoStatus par $firstnameAdmin";
    $message = "<!DOCTYPE html>
    <html lang=\"fr\">
    <head>
        <meta charset=\"UTF-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    </head>
    <body>
        <p>Hey $firstname, il y a du nouveau ! Votre réservation $infoStatus par $firstnameAdmin 😎 (admin de lacshelter)</p>
        <p><span style=\"font-weight:bold;\">Réservation pour :</span> $people personne(s)</p>
        <p><span style=\"font-weight:bold;\">Date de début du séjour :</span> $dateCheckIn</p>
        <p><span style=\"font-weight:bold;\">Date de départ du séjour :</span> $dateCheckOut</p>
        <a href=\"https://lacshelter.com/\"><button style=\"-webkit-appearance: none;border: 0;padding: 15px 40px;border-radius: 100px;background-color: #0083bb;cursor: pointer !important;color: white;font-weight: bold;font-size: 1.2em;\"</button>Voir la réservation</a>
    </body>
    </html>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <Reservation@no-reply.com>' . "\r\n";
    return mail($to, $subject, $message, $headers);
}