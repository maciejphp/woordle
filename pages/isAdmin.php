<?php
session_start();
$config = include(../config.php);

var_dump($_SESSION)

$sUser = $config['name'];
$sPass = $config['pass'];
$sDB = $config['name'];
$shost = $config['host'];
$conn = new mysqli($shost, $sUser, $sPass, $sDB);

$getAdmin = $conn->prepare('SELECT isAdmin FROM users WHERE Username = ?')
$getAdmin->bind_param("s", )