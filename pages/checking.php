<?php
// This is the checking page, it checks if the user is in the database and if the password is correct.
$config = include('../config.php');

$User = $_POST["Username"];
$Pass = $_POST["Password"];
$Email = $_POST["Email"];

$shost = $config['host'];
$suser = $config['user'];
$spass = $config['pass'];
$db = $config['name'];

// Create connection
$connection = new mysqli($shost, $suser, $spass, $db);
$Statement = $connection->prepare('SELECT Username, Password, Email, IsAdmin FROM users WHERE Username = ?');
if (preg_match('/^[a-zA-Z0-9]+$/', $User)) { // Check if the input is valid
    $Statement->bind_param('s', $User);
    $Statement->execute();
    $Statement->bind_result($Username, $Password, $Email2, $IsAdmin);
    $Statement->fetch();
    if ($User == $Username && $Pass == $Password) {
        session_start();
        $_SESSION["Username"] = $User;
        $_SESSION["IsAdmin"] = $IsAdmin;
        sleep(2); // Delay in 2 seconds
        header("Location: ../index.php");
    } else {
        sleep(2); // Delay in 2 seconds, redirect and show error
        $_GET['err'] = 1;
        header("Location: login.php");
        echo "<script>alert('Invalid Username or Password');</script>";
    }
} else {
    sleep(2); // Delay in 2 seconds, redirect and show error
    $_GET['err'] = 2;
    header("Location: login.php");
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body, html{
            margin: 0;
            padding: 0;
            height: 100%;
        }
        body{
            background: #c6d3e3;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <h2>Loading...</h2>
</body>
</html>
