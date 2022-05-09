<?php
//process verwijderen van operatie na confirmatie
if (isset($_POST["id"]) && !empty($_POST["id"])){
    //Include config file
    require "php/config/config.php";

    //prepare verwijder statement
    $query = "DELETE FROM `booking` WHERE `id` = :id";
    if ($stmt = $pdo->prepare($query)){

        //set parameters
        $param_id = trim($_POST["id"]);

        //bind variables
        $stmt->bindParam(":id", $param_id);

        //poging om de prepared statement te uitvoeren
        if ($stmt->execute()) {
            //als het gelukt is redirect naar ladings pagina
            header("location: info.php");
            exit();
        }else{
            echo "Er is iets fouts gegaan. Probeer later opnieuw.";
        }

        //Statement afsluiten
        unset($stmt);

        //connectie afsluiten
        unset($pdo);
    }else {
        //Check of een id parameter bestaat
        if (empty(trim($_GET["id"]))){
            //Als de url geen parameter id kan vinden. Redirect naar een error pagina.
            header("location: error.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5 mb-3">Verwijder afspraak</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="alert alert-danger">
                        <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                        <p>Are you sure you want to delete this appointment?</p>
                        <p>
                            <input type="submit" value="Yes" class="btn btn-danger">
                            <a href="index.php" class="btn btn-secondary ml-2">No</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
