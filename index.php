<?php
// initialiseer de session
session_start();

//Voegt config.php toe aan de pagina
include "php/config/config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
    <!-- Geeft speciaale waardes door aan de navbar.php -->
    <?php $title = "Welkom"; ?>
    <?php $info = "We hopen u snel te zien!"; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/media.css">
</head>
<!-- Voegt navbar.php toe aan de pagina -->
<?php include "php/assets/navbar.php"; ?>
<body>

</body>
<?php include "php/assets/footer.php"; ?>
</html>