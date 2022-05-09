<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login/login.php");
    exit;
}

error_reporting(E_ALL);
ini_set('display_errors', '1');

include "../config/config.php";
include "../verwerken/reserverenVerwerken.php";

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="../../assets/css/primary_color.css">
</head>
<body>
<div class="container">
    <h1 class="text-center">Book for Date: <?php echo date('F d, Y', strtotime($date)); ?></h1>
    <p class="text-center"><?php echo date('d/m/Y', strtotime($date)); ?></p>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <?php echo(isset($msg))?$msg:""; ?>
        </div>
        <?php $timeslots = timeslots($duration, $cleanup, $start, $end);

//        echo '<pre>';
//        echo var_dump($timeslots);
//        echo '</pre>';

        foreach($timeslots as $ts){
            ?>
            <div class="col-md-2">
                <div class="form-group">
                    <?php

                    //hier haal ik specefiek de date en timeslot op uit de database
                    $timeSql = "SELECT `timeslot` FROM `booking` WHERE `date`=:date AND `timeslot`=:timeslot";
                    $stmt = $pdo->prepare($timeSql);
                    $stmt->bindParam(':timeslot', $ts);
                    $stmt->bindParam(':date', $date);
                    $bookings = array();
                    $stmt->execute();

                    // if ts/$timeslot = boockings[]==5 then button RED else button GREEN

                    if($stmt->rowCount()>=5){ ?>
                        <button class="btn btn-danger"><?php echo $ts; ?></button>
                    <?php }else{ ?>
                        <button class="btn btn-success book" data-timeslot="<?php echo $ts; ?>"  data-date="<?php echo $date; ?>"><?php echo $ts; ?></button>
                    <?php }  ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog"></div>
<script src='../../ajax/jquery-3.1.1.min.js' type='text/javascript'></script>
<script rel="script" src="../../ajax/ajax.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</body>
</html>
