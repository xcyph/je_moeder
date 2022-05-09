<?php
// laat de fout meldingen zien
error_reporting(E_ALL);
ini_set('display_errors', '1');

// initialiseer de session
session_start();

//Voegt config.php toe aan de pagina
require_once "../config/config.php";

//Voegt loginVerwerken.php toe aan de pagina
require_once "../verwerken/loginVerwerken.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/login.css">
</head>
<body>
<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>

<?php
if(!empty($login_err)){
    echo '<div class="alert alert-danger">' . $login_err . '</div>';
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h3>Login Here</h3>

    <label>Username</label>
    <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
    <span class="invalid-feedback"><?php echo $username_err; ?></span>

    <label>Password</label>
    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
    <span class="invalid-feedback"><?php echo $password_err; ?></span>
    <br>
    <input type="submit" class="btn btn-primary" value="Login">
    <br>
        <div style="text-align: center">
            <p>Don't have an account?</p>
            <p><a href="register.php">Sign up now</a>.</p>
        </div>
    </div>
</form>
</body>
</html>