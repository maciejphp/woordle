<?php
session_start();
$_SESSION['Username'] = NULL;
$_SESSION['IsAdmin'] = NULL;

sleep(2);
header("Location: ../index.php");

?>
<p>Hola</p>
