<?php
// laat foutmeldingen zien
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Include config file
require_once "../config/config.php";

// Define variables and initialize with empty values
$username = $lastname = $password = $email = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
//        // Prepare a select statement
//        $sql = "SELECT * FROM customer WHERE username = :username";
//
//        if($stmt = $pdo->prepare($sql)){
//            // Bind variables to the prepared statement as parameters
//            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Zet parameter
            $username = trim($_POST["username"]);

//            // Attempt to execute the prepared statement
//            if($stmt->execute()){
//                if($stmt->rowCount() == 1){
//                    $username_err = "This username is already taken.";
//                } else{
//                    $username = trim($_POST["username"]);
//                }
//            } else{
//                echo "Oops! Something went wrong. Please try again later.";
//            }
//
//            // Close statement
//            unset($stmt);
//        }
    }

    // Zet parameter
    $lastname = (trim($_POST["lastname"]));

    // Zet parameter
    $email = (trim($_POST["email"]));

    // Valideer password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Valideer confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Controleer invoerfouten voordat u deze in de database invoegt
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare en insert statement
        $sql = "INSERT INTO customer (username, lastname, password, email) VALUES (:username,:lastname, :password, :email)";

        // Bind variabelen aan de prepared statement als parameters
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":lastname", $param_lastname, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            // Zet parameters
            $param_username = $username;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // execute de prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Sluit statement
            unset($stmt);
        }
    }

    // Sluit connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/login.css">
    <style>
        body{
            font: 14px sans-serif;
        }
        .wrapper{
            width: 360px; padding: 20px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h3>Register Here</h3>

            <label>Username</label>
            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <!-- Laat de error zien onder het input veld -->
            <span class="invalid-feedback" style="color: white"><?php echo $username_err; ?></span>

            <label>Lastname</label>
            <!-- Laat de error zien onder het input veld -->
            <input type="text" name="lastname" value="<?php echo $lastname; ?>">

            <label>E-mail</label>
            <input type="email" name="email" value="<?php echo $email; ?>">

            <label>Password</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            <!-- Laat de error zien onder het input veld -->
            <span class="invalid-feedback" style="color: white"><?php echo $password_err; ?></span>

            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
            <!-- Laat de error zien onder het input veld -->
            <span class="invalid-feedback" style="color: white"><?php echo $confirm_password_err; ?></span>
            <br>
            <input type="submit" class="btn btn-primary" value="Login">
            <br>
            <div style="text-align: center">
                <p>Already have an account?</p>
                <p><a href="login.php">Login now</a>.</p>
            </div>
        </form>
    </div>
</body>
</html>