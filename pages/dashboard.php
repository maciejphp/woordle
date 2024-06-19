<?php
session_start();
$config = include("../config.php");

$SessUser = $_SESSION['Username'];
$SessIsAdmin = $_SESSION['IsAdmin'];

$sUser = $config['user'];
$sPass = $config['pass'];
$sDB = $config['name'];
$shost = $config['host'];
$conn = new mysqli($shost, $sUser, $sPass, $sDB);

$getAdmin = $conn->prepare('SELECT isAdmin FROM users WHERE Username = ?');
$getAdmin->bind_param("s", $SessUser);
$getAdmin->bind_result($isAdmin);

if(!$SessIsAdmin == $isAdmin) {
    header("../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../src/css/dashboard.css">
</head>
<body>
    <header>
        <h2>Dashboard</h2>
        <p id="people_online">People online:</p>
        <script>
            //connect to the server
            const webSocket = new WebSocket('wss://goofy-woordle-game.glitch.me/');
            webSocket.onmessage = (message)=>{
                document.getElementById("people_online").innerText = `People online: ${message.data}`;
            }
        </script>
        
    </header>
    <div class="container">
        <div class="een"><iframe src="../iframe/leaderboard/leaderboard.php" frameborder="0"></iframe></div>
        <div class="twee"><iframe src="../iframe/isadmin/isadmin.php" frameborder="0"></iframe></div>
        <div class="drie"><iframe src="../iframe/words/words.html" frameborder="0"></iframe></div>
    </div>
</body>
</html>