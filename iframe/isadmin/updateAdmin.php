<?php

$config = include("../../config.php");

$user = $_POST["Username"];

$sUser = $config['user'];
$sPass = $config['pass'];
$sHost = $config['host'];
$sDB = $config['name'];

$conn = new mysqli($sHost, $sUser, $sPass, $sDB);

var_dump($_POST);
if(isset($_POST["isAdmin"])){
    $Update = $conn->prepare("UPDATE users SET IsAdmin=1 WHERE Username=?");
    $Update->bind_param("s", $user);
    $Update->execute();
    Sleep(2);
    header('Location: isadmin.php');
} else {
    $Update = $conn->prepare("UPDATE users SET IsAdmin=0 WHERE Username=?");
    $Update->bind_param("s", $user);
    $Update->execute();
    Sleep(2);
    header('Location: isadmin.php');
}