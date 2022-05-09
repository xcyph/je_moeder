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

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>
    <link rel="stylesheet" href="../../assets/css/primary_color.css">
</head>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Booking for: <span id="slot"></span></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">Time Slot</label>
                                    <input readonly type="text" class="form-control" id="timeslot" name="timeslot" value="<?php echo $_POST['ts'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Emplyee</label>
                                    <select required name="employee" id="employee">
                                        <option> -- Select Employee --</option>
                                        <?php

                                        //hier mee zorg ik dat de employee tabel word opgehaald
                                        $selectEmployee = "select * from employee ";
                                        $stmt = $pdo->prepare($selectEmployee);
                                        $stmt->execute();

                                        while ($row= $stmt->fetch(PDO::FETCH_ASSOC)){

                                            // hier haal ik de date en time slot uit de database samen met het id van de employee
                                            $employeeSql = "select * from booking where date=:date AND timeslot=:timeslot AND employeeName=:employeeName";
                                            $stmt2 = $pdo->prepare($employeeSql);
                                            $stmt2->bindParam(':date', $_POST['date']);
                                            $stmt2->bindParam(':timeslot', $_POST['ts']);
                                            $stmt2->bindParam(':employeeName', $row['id']);
                                            $stmt2->execute();

                                            if($stmt2->rowCount() > 0) {
                                                echo "<option disabled value='".$row['id']."'>".$row['name']."</option>";
                                            } else {
                                                echo "<option value='".$row['id']."'>".$row['name']."</option>";
                                            }



//                                            if ($stmt2->fetch(PDO::FETCH_ASSOC) == $row['employeeName'] ){
//
//                                                echo "<option disabled value='".$row['name']."'>".$row['name']."</option>";
//
//                                            }elseif ($row['employeeName']){
//
//                                                echo "<option value='".$row['name']."'>".$row['name']."</option>";
//
//                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php
                                // Verbindt en haalt de "id" uit de database
                                $idSql = "select * from customer WHERE id=:id";
                                $stmt = $pdo->prepare($idSql);

                                //verbind ":id" met session id
                                $stmt->bindParam(':id', $_SESSION["id"]);

                                // Bind variabelen aan de prepared statement als parameters
                                if($stmt->execute() && $stmt->rowCount() > 0) {
                                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                                    $username = $user['username'];
                                    $email = $user['email'];
                                }
                                ?>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input required type="text" class="form-control" value="<?php echo $username ?>" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input required type="email" class="form-control" value="<?php echo $email ?>" name="email">
                                </div>
                                <div class="form-group pull-right">
                                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
