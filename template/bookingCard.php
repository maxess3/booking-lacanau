<?php 

ob_start(); 

?>

<div class="booking-card">
    <div class="status-msg">Statut mis à jour par l'admin<span class="bold-status">$updatedAtFR</span>à<span class="bold-status">$updatedAtTime</span></div>
    <div class="status $statusClass">$statusTitle<span class="update-time-status orange-status"><img src="assets/img/info.svg" class="icon"></span></div>
    <div class="delete-booking" data-id="$idAppartment"><img src="assets/img/delete.svg" alt="Supprimer la réservation"/></div>
    <div class="card-info-people unique-card-color">
        <span>$firstname $lastname</span>
        <span>@$username</span>
    </div>
    <div class="card-info-booking">
        <span class="title-info-booking">A réservé du :</span>
        <div class="date-booking">
            <span class="date-checkin">$dateCheckInFR</span> 
            <span class="date-checkout">$dateCheckOutFR</span>
        </div>
        <div class="date-booking">
            <span>$hourCheckInFR</span>
            <span>$hourCheckOutFR</span>
        </div>
        <span class="title-info-booking"><img src="assets/img/user.svg" class="user-icon-card"/>Nombre de personnes :</span>
        <span><span class="unique-people-number">$people</span></span>
    </div>
    <div class="delete-booking" data-id="$idAppartment"><img src="assets/img/delete.svg" alt="Supprimer la réservation"/></div>
    <div title="Add to Calendar" class="addeventatc custom-calendar" data-styling="none">
    Ajouter au calendrier
        <span class="start">$dateCalendarCheckInFR $hourCalendarCheckInFR</span>
        <span class="end">$dateCalendarCheckOutFR $hourCalendarCheckOutFR</span>
        <span class="timezone">Europe/Paris</span>
        <span class="title">Réservation Appartement 669 à Lacanau Océan</span>
        <span class="description">Réservation Appartement 669, Résidence Océanide, Lacanau-Océan ($people personnes)</span>
        <span class="location">Residence Oceanides, Rés Front de Mer, 33680 Lacanau, France</span>
    </div>
</div>

<?php $persoBookingPending = ob_get_contents(); ?>

<div class="booking-card">
<div class="status-msg">Statut mis à jour par l'admin<span class="bold-status">$updatedAtFR</span>à<span class="bold-status">$updatedAtTime</span></div>
<div class="status $statusClass">$statusTitle<span class="update-time-status"><img src="assets/img/info.svg" class="icon"></span></div>
<div class="delete-booking" data-id="$idAppartment"><img src="assets/img/delete.svg" alt="Supprimer la réservation"/></div>
    <div class="card-info-people unique-card-color">
        <span>$firstname $lastname</span>
        <span>@$username</span>
    </div>
    <div class="card-info-booking">
        <span class="title-info-booking">A réservé du :</span>
        <div class="date-booking">
            <span class="date-checkin">$dateCheckInFR</span> 
            <span class="date-checkout">$dateCheckOutFR</span>
        </div>
        <div class="date-booking">
            <span>$hourCheckInFR</span>
            <span>$hourCheckOutFR</span>
        </div>
        <span class="title-info-booking"><img src="assets/img/user.svg" class="user-icon-card"/>Nombre de personnes :</span>
        <span><span class="unique-people-number">$people</span></span>
    </div>
    <div class="delete-booking" data-id="$idAppartment"><img src="assets/img/delete.svg" alt="Supprimer la réservation"/></div>
    <div title="Add to Calendar" class="addeventatc custom-calendar" data-styling="none">
        Ajouter au calendrier
        <span class="start">$dateCalendarCheckInFR $hourCalendarCheckInFR</span>
        <span class="end">$dateCalendarCheckOutFR $hourCalendarCheckOutFR</span>
        <span class="timezone">Europe/Paris</span>
        <span class="title">Réservation Appartement 669 à Lacanau Océan</span>
        <span class="description">Réservation Appartement 669, Résidence Océanide, Lacanau-Océan ($people personnes)</span>
        <span class="location">Residence Oceanides, Rés Front de Mer, 33680 Lacanau, France</span>
    </div>
</div>

<?php 

$persoBookingApproved = ob_get_contents(); 

ob_end_clean();

?>