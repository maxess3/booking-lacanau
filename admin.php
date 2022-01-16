<?php

require_once("functions/function.php");

session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1">
    <title>Gérer les réservations</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <table>
        <caption><span class="backToIndex"><img src="assets/img/arrow-left.svg" alt="Revenir à la page d'accueil"></span>Gérer les réservations</caption>
        <thead>
        <tr>
          <th scope=col>Nom</th>
          <th scope=col>Prénom</th>
          <th scope=col>Nom d'utilisateur</th>
          <th scope=col>Jour d'arrivée</th>
          <th scope=col>Jour de départ</th>
          <th scope=col>Créé le</th>
          <th scope=col>Statut</th>
        </tr>
        <tbody>
<?php 
        if($_SESSION["admin"] && $_SESSION["admin"] == 1){
            echo "<tr>
                <td colspan=\"7\" class=\"listPending\">En attente</td>
            </tr>";
            getBookingAdmin(0);
            echo "<tr>
                <td colspan=\"7\" class=\"listAccepted\">Validé</td>
            </tr>";
            getBookingAdmin(1);
            echo "<tr>
                <td colspan=\"7\" class=\"listRejected\">Refusé</td>
            </tr>";
            getBookingAdmin(2);
        } else {
            header("Location: " . "index.php?error=wrongAccess");
        }
?>
      </tbody>
    </table>
<script src="js/admin.js"></script>
</body>
</html>