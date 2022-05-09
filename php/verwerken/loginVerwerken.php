<?php

// Geeft de variables Lege values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Form verwerken wanneer formulier wordt ingediend
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Controleer of "username" leeg is
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Controleer of "password" leeg is
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Valideer credentials
    if(empty($username_err) && empty($password_err)){

        // Prepare en select statement
        $sql = "SELECT id, username, password FROM customer WHERE username = :username";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables aan de prepared statement als parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Zet parameters
            $param_username = trim($_POST["username"]);

            // Execute de prepared statement
            if($stmt->execute()){
                // Controleer of de "username" bestaat, zo ja, verifieer dan het "password"
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, start een nieuwe session
                            session_start();

                            // Stopt de data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Stuurd de gebruiker naar de index.php
                            header("location: ../../index.php");
                        } else{
                            // Password is niet geldig, geef een algemene foutmelding weer
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // "Username" doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}
