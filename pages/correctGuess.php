<?php
session_start();

var_dump($_SESSION);
$config = include('../config.php');

$shost = $config['host'];
$suser = $config['user'];
$spass = $config['pass'];
$db = $config['name'];

// Create connection
$connection = new mysqli($shost, $suser, $spass, $db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="center">
        <?php
        if ($_SESSION == NULL){
            echo "<p>You need an account in order to save your progress!";
        } else {
            $stmt_Recieve = $connection->prepare("SELECT CorrectGuesses FROM users WHERE Username = ?");
            $stmt_Recieve->bind_param('s', $_SESSION['Username']);
            $stmt_Recieve->execute();
            $stmt_Recieve->bind_result($CorrectGuesses);
            $stmt_Recieve->fetch();

            $stmt_Recieve->close();
            $CorrectGuesses += 1;
            $stmt_Update = $connection->prepare("UPDATE users SET CorrectGuesses = ? WHERE Username = ?");
            $stmt_Update->bind_param("is", $CorrectGuesses, $_SESSION['Username']);
            $stmt_Update->execute();

            $stmt_Update->close();
            $connection->close();
            header("Location: ../index.php");
        }
        ?>
    </div>
</body>
</html>


