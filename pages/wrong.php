<?php
session_start();
$config = require("../config.php");

$sUser = $config['user'];
$sDb = $config['name'];
$sPass = $config['pass'];
$sHost = $config['host'];
$Username = $_SESSION['Username'];

$conn = new mysqli($sHost, $sUser, $sPass, $sDb);
$stmt = $conn->prepare("SELECT GamesPlayed FROM users WHERE Username = ?");
$stmt->bind_param('s', $Username);
$stmt->execute();
$stmt->bind_result($GamesPlayed);
$stmt->fetch();
$stmt->close();

$GamesPlayed += 1;
$update = $conn->prepare("UPDATE users SET GamesPlayed = ? WHERE Username = ?");
$update->bind_param('is', $GamesPlayed, $Username);
$update->execute();
$update->close();
$conn->close();
sleep(1);
header('Location: ../index.php');