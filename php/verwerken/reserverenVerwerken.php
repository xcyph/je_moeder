<?php


error_reporting(E_ALL);
ini_set('display_errors', '1');


if(isset($_GET['date'])){
            $date = $_GET['date'];
            $dateSql = "select * from booking where date=:date";
            $stmt = $pdo->prepare($dateSql);
            $stmt->bindParam(':date', $date);
            $bookings = array();
            if($stmt->execute()){
            if($stmt->rowCount()>5){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $bookings[] = $row['timeslot'];

            }
            unset($stmt);
       }
    }
}

if(isset($_POST['submit'])){
//laat session dump zien
//    echo '<pre>';
//    var_dump($_SESSION);
//    echo '</pre>';


            $name = $_POST['name'];
            $email = $_POST['email'];
            $timeslot = $_POST['timeslot'];
            $employee = $_POST['employee'];
            $selectSql = "select * from booking where date = :date AND timeslot=:timeslot";
            $stmt = $pdo->prepare($selectSql);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':timeslot', $timeslot);
            if($stmt->execute()){
            if($stmt->rowCount()>=5){
            $msg = "<div class='alert alert-danger'>Already Booked</div>";
            }else{
            $insertSql = "
                INSERT INTO booking (
                    name, timeslot, email, date, employeeName, customer_id
                ) VALUES (
                    :name, :timeslot, :email, :date, :employee, :customer_id
                )
            ";

            $stmt = $pdo->prepare($insertSql);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':timeslot', $timeslot);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':date', $date);
                $stmt->bindParam(':employee', $employee);
                $stmt->bindParam(':customer_id', $_SESSION['id']);
            $stmt->execute();

            header('Location: ../../show.php');

            $msg = "<div class='alert alert-success'>Booking Successfull</div>";
            $bookings[] = $timeslot;

            unset($stmt);
        }
    }
}

$duration = 30;
$cleanup = 0;
$start = "09:00";
$end = "17:30";

function timeslots($duration, $cleanup, $start, $end){
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT".$duration."M");
    $cleanupInterval = new DateInterval("PT".$cleanup."M");
    $slots = array();

    for($intStart = $start; $intStart<$end; $intStart->add($interval)->add($cleanupInterval)){
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if($endPeriod>$end){
        break;
    }

    $slots[] = $intStart->format("H:i")." - ". $endPeriod->format("H:i"). " ";

    }

    return $slots;
}
