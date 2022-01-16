<?php 

ob_start();

date_default_timezone_set('Europe/London');

$datetime = new DateTime('tomorrow');

?>

<div class="inner-form">
    <div>           
        <label for="people">Personne(s) :</label>
        <input type="number" min="1" max="10" id="people" name="people" value="<?= isset($_POST['people']) && !empty($_POST['people']) ? $_POST['people'] : 1 ?>">
    </div>     
    <div>
        <label for="date-checkin">Jour d'arrivée :</label>
        <input type="date" id="date-checkin" name="date-checkin" value="<?= isset($_POST['date-checkin']) && !empty($_POST['date-checkin']) ? $_POST['date-checkin'] : date('Y-m-d') ?>">
    </div>
    <div>
        <label for="hour-checkin">Heure d'arrivée :</label>
        <input type="time" id="hour-checkin" name="hour-checkin" value="<?= isset($_POST['hour-checkin']) && !empty($_POST['hour-checkin']) ? $_POST['hour-checkin'] : "12:00" ?>">
    </div>
    <div>
        <label for="date-checkout">Jour de départ :</label>
        <input type="date" id="date-checkout" name="date-checkout" value="<?= isset($_POST['date-checkout']) && !empty($_POST['date-checkout']) ? $_POST['date-checkout'] : $datetime->format('Y-m-d')?>">
    </div>
    <div>           
        <label for="hour-checkout">Heure du départ :</label>
        <input type="time" id="hour-checkout" name="hour-checkout" value="<?= isset($_POST['hour-checkout']) && !empty($_POST['hour-checkout']) ? $_POST['hour-checkout'] : "12:00" ?>">
    </div>
    <div class="btn-booking">           
        <button type="submit" id="submit-booking" name="submitBooking">Réserver</button>
    </div>
</div>

<?php

$searchBarConnected = ob_get_clean();

?>
    <button type="submit" id="submit-booking" name="submitBooking"  class="connect-btn">Se connecter</button>
<?php

$searchBarNotConnected = ob_get_clean();

?>