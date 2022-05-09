<?php
// initialiseer de session
session_start();

// Controleert of er een gebruiker ingelogd is zo niet stuur naar de inlog pagina
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: php/login/login.php");
    exit;
}

//Voegt config.php toe aan de pagina
include "php/config/config.php";

//Voegt showVerwerken.php toe aan de pagina
include "php/verwerken/showVerwerken.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
    <!-- Geeft speciaale waardes door aan de navbar.php -->
    <?php $title = "Booking"; ?>
    <?php $info = "Hier kunt u een afspraken naar keuzen maken"; ?>
    <link rel="stylesheet" href="assets/css/show.css">
    <link rel="stylesheet" href="assets/css/primary_color.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/media.css">
    <style>

        table{
            table-layout: fixed;
            text-align: center;
            background-color: rgba(255,255,255,0.13);
        }

        td{
            width: 33%;
        }

        .today{
            background: yellow;
        }
    </style>
</head>
    <body>
        <!-- Voegt navbar.php toe aan de pagina -->
        <?php include "php/assets/navbar.php"; ?>
        <div class="container" style="text-align: center;">
            <div class="col-md-12">
            </div>
                    <div id="calendar">
                        <?php
                        //  haalt en leest de datum uit
                            $dateComponents = getdate();
                            $month = $dateComponents['mon'];
                            $year = $dateComponents['year'];

                        //  bouwt de kalender op de pagina
                            echo build_calendar($_GET['month'] ?? $month, $_GET['year'] ?? $year);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
<?php include "php/assets/footer.php"; ?>
</html>