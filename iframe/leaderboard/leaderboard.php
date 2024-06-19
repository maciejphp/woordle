<?php
$config = include("../../config.php"); // Include the config file

$sUser = $config['user'];
$sPass = $config['pass'];
$sHost = $config['host'];
$sDB = $config['name'];

$conn = new mysqli($sHost, $sUser, $sPass, $sDB); // Create a new connection

$leaderboard = $conn->prepare("SELECT Username, Correctguesses FROM users WHERE IsAdmin=0 ORDER BY CorrectGuesses DESC"); // Prepare the query
$leaderboard->execute();
$leaderboard->bind_result($Username, $Correctguesses); 

echo "<table>";
echo "<tr><th class='br1'>Username</th><th>Correctguesses</th></tr>";
while($leaderboard->fetch()){ // Fetch the results and display them in a table
    echo "<tr><td class='br1'>$Username</td><td>$Correctguesses</td></tr>";
}
echo "</table>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            font-family: 'Courier New', Courier, monospace;
        }
        th{
            font-size: 1.5em;
            border-bottom: 1px gainsboro solid;
        }
        td{
            border-bottom: 1px gainsboro solid;
            font-size: 1.2em;
        }
        .br1{
            border-right: 1px gainsboro solid;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    
</body>
</html>