<?php
$config = include("../../config.php"); // Include the config file

$sUser = $config['user'];
$sPass = $config['pass'];
$sHost = $config['host'];
$sDB = $config['name'];
$Username = $_POST['Username'];

$conn = new mysqli($sHost, $sUser, $sPass, $sDB); // Create a new connection

$leaderboard = $conn->prepare("UPDATE users SET CorrectGuesses=0, GamesPlayed=0 WHERE Username=?"); // Prepare the query
$leaderboard->bind_param("s", $Username);
$leaderboard->execute();
$leaderboard->close();
$conn->close();
sleep(1);
header("Location: leaderboard.php");