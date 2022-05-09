<?php
//$localhost = "localhost";
//$db_hostname = "84219";
//$db_password = "Warframe134!";
//$db_database = "84219";
//
//$mysqli = mysqli_connect($localhost,$db_hostname,$db_password,$db_database);
//
//if (!$mysqli){
//    echo "Er is geen verbinding";
//}


/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', '84648');
define('DB_PASSWORD', 'bL$4g98e');
define('DB_NAME', '84648_database');

/* Attempt to connect to MySQL database */
try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
