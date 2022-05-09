<?php

// Controleert of er een gebruiker ingelogd is zo niet stuur naar de inlog pagina
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true) {
    header("location: php/login/login.php");
    exit;
}

?>

<link rel="stylesheet" href="assets/css/nav.css">
<link rel="stylesheet" href="assets/css/media.css">
<div class="header">
    <!-- Geeft speciaale waardes door aan de navbar.php -->
    <?php echo "<h1>" . $title . "</h1>"; ?>
    <?php echo "<p>" . $info . "</p>"; ?>
</div>

<div class="topnav">
    <?php
    // Controleert of er een gebruiker ingelogd is zo niet laad die een andere list in
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        echo"<a href='index.php'>Home</a>";
        echo "<a href='show.php'>Booking</a>";
//        echo "<a href='review.php'>Reviews</a>";
        echo "<a href='php/login/logout.php' style='float: right'>Logout</a>";
        echo "<a href='info.php' style='float: right'>Info</a>";
    }else{
        echo"<a href='index.php'>Home</a>";
        echo "<a href='php/login/login.php'>Booking</a>";
//        echo "<a href='php/login/login.php'>Reviews</a>";
        echo "<a href='php/login/login.php' style='float: right'>Login</a>";
        echo "<a href='info.php' style='float: right'>Info</a>";
    }
    ?>
</div>
