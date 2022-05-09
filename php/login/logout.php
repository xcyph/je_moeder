<?php
// initialiseer de session
session_start();

// Leegt alle session variable
$_SESSION = array();

// Sluit de session
session_destroy();

// Stuurd Naar login.php
header("location: ../../index.php");
exit;
