<?php
// laat foutmeldingen zien
error_reporting(E_ALL);
ini_set('display_errors', '1');

// initialiseer de session
session_start();

// Controleert of er een gebruiker ingelogd is zo niet stuur naar de inlog pagina
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: php/login/login.php");
    exit;
}

// Voegt config.php toe aan de pagina
include "php/config/config.php";

// Verbindt en haalt de "id" uit de database
$idSql = "select * from customer WHERE id=:id";
$stmt = $pdo->prepare($idSql);

//verbind ":id" met session id
$stmt->bindParam(':id', $_SESSION["id"]);

// Bind variabelen aan de prepared statement als parameters
if($stmt->execute() && $stmt->rowCount() > 0) {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $username = $user['username'];
    $lastname = $user['lastname'];
    $email = $user['email'];
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Prepare an update statement
        $sql = "UPDATE `customer` SET `username`=:username, `lastname`=:lastname, `email`=:email WHERE `id`=:id";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $_POST['username'], PDO::PARAM_STR);
            $stmt->bindParam(":lastname", $_POST['lastname'], PDO::PARAM_STR);
            $stmt->bindParam(":email", $_POST['email'], PDO::PARAM_STR);

            //verbind ":id" met session id
            $stmt->bindParam(':id', $_SESSION["id"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Password updated successfully. Destroy the session, and redirect to login page
                header("location: info.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Info Page</title>
    <!-- Geeft speciaale waardes door aan de navbar.php -->
    <?php $title = "Info"; ?>
    <?php $info = "Hier kunt u de gegevens veranderen en afspraken afzeggen"; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/media.css">
    <link rel="stylesheet" href="assets/css/info.css">
    <link rel="stylesheet" href="assets/css/media.css">
</head>
<!-- Voegt navbar.php toe aan de pagina -->
<?php include "php/assets/navbar.php"; ?>
<body>
<div class="row">
    <div class="column">
        <div class="column-style">
            <div class="column-inside-left" >
                <h2>Persoonlijke gegevens</h2>
            </div>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
                <div class="column-inside-left">
                    <div>
                        Voornaam: <input type="text" name="username" value="<?php echo $username; ?>">
                    </div>
                </div>
                <hr>
                <div class="column-inside-left">
                    <div>
                        Achternaam: <input type="text" name="lastname" value="<?php echo $lastname; ?>">
                    </div>
                </div>
                <hr>
                <div class="column-inside-left">
                    <div>
                        E-mail: <input type="text" name="email"  value="<?php echo $email; ?>">
                    </div>
                </div>
                <div  class="column-inside-left">
                    <div>
                        <button class="button" type="submit" >Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="column">
        <div class="column-style">
            <div class="column-inside-right" >
                <h2>Bookings</h2>
            </div>
            <div>
                <?php

                //Delete query


                // Verbindt en haalt de "id" uit de database
                $bookingSql = "select * from `booking` WHERE `customer_id`=:customer_id";
                $bookingStmt = $pdo->prepare($bookingSql);
                $bookingStmt->bindParam(":customer_id", $_SESSION["id"]);

                $bookingStmt->execute();

                while ($row= $bookingStmt->fetch(PDO::FETCH_ASSOC)) {

                    //hier selecteer ik de employee tabel
                    $selectEmployee = "select * from `employee` WHERE id=:id";
                    $employeeStmt = $pdo->prepare($selectEmployee);
                    $employeeStmt->bindParam(":id", $row['employeeName']);

                    $employeeStmt->execute();

                    //hier haal ik de array op uit de employee tabel
                    $employee = $employeeStmt->fetch(PDO::FETCH_ASSOC);


                    //echo '<form action="delete.php" method="post">';
                    echo '<div class="column-inside-right">';
//                    echo '<p> Afspraak met: ' . $employee['id'] . '</p>';
                    echo '<p> Afspraak met: ' . $employee['name'] . '</p>';
                    echo '<p> Datum: '  . $row['date'] . '</p>';
                    echo '<p> Tijd: ' . $row['timeslot'] . '</p>';
                    echo '<a href="delete.php?id='.$row['id'].'">Verwijderen</a>';
                    //echo '<button class="button" style="background-color: #c70000">Verwijderen</button>';
                    echo '</div>';
                    //echo '</form>';
                    echo '<hr>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
<?php include "php/assets/footer.php"; ?>
</html>
