<?php
// initialiseer De session
//session_start();

// Controleert of er een gebruiker ingelogd is zo niet stuur naar de inlog pagina
//if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//    header("location: php/login/login.php");
//    exit;
//}

//Voegt config.php toe aan de pagina
include "php/config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
    <!-- Geeft speciaale waardes door aan de navbar.php-->
    <?php $title = "Review"; ?>
    <?php $info = "Hier kunt u de reviews van onze tevreden klanten zien"; ?>
    <link rel="stylesheet" href="assets/css/review.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/media.css">
</head>
<!--  Voegt navbar.php toe aan de pagina  -->
<?php include "php/assets/navbar.php"; ?>
<body>

</body>
<?php include "php/assets/footer.php"; ?>
</html>
