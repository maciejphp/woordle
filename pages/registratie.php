<?php

$config = include('../config.php');

$User = $_POST["Username"];
$Pass = $_POST["Password"];
$Email = $_POST["email"];

$pass2 = $_POST["pass2"];
$email2 = $_POST["email2"];

$shost = $config['host'];
$suser = $config['user'];
$spass = $config['pass'];
$db = $config['name'];

// Create connection
$connection = new mysqli($shost, $suser, $spass, $db);
if (preg_match('/^[a-zA-Z0-9]+$/', $User && $Pass == $pass2 && $Email == $email2)) { // Check if the input is valid Check if the passwords and emails match
    $sql = "INSERT INTO users (Username, Password, Email) VALUES ('$User', '$Pass', '$Email')";
    if ($connection->query($sql) === true) {
        echo "New record created successfully, sending you back.";
        $_SESSION["Username"] = $User;
        $_SESSION["IsAdmin"] = 0;
        sleep(2);
        header("Location: ../index.php");
    } else {
        echo "Error, Please contact the Administator";
    }
}


