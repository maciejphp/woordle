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
        .b1px{
            border: 1px solid black;
            width: 42.5%;
            border-radius: 10px;
        }
        .gray{
            background: #F0F0F0;
        }
        .bottom{
            padding:2px;
            position: absolute;
            cursor: move;
        }
    </style>
</head>
<body>
<script>
            document.addEventListener('DOMContentLoaded', (event) => {
            const draggable = document.getElementById('draggable');
            const inputField = document.getElementById('editableInput');
            let offsetX, offsetY, isDragging = false;

            draggable.addEventListener('mousedown', (e) => {
                if (e.target === inputField) {
                    return; // Do not drag when clicking on the input field
                }
                isDragging = true;
                offsetX = e.clientX - draggable.offsetLeft;
                offsetY = e.clientY - draggable.offsetTop;
                draggable.style.cursor = 'grabbing';
                e.preventDefault(); // Prevents default behavior such as text selection
            });

            document.addEventListener('mousemove', (e) => {
                if (isDragging) {
                    draggable.style.left = `${e.clientX - offsetX}px`;
                    draggable.style.top = `${e.clientY - offsetY}px`;
                }
            });

            document.addEventListener('mouseup', () => {
                isDragging = false;
                draggable.style.cursor = 'move';
            });

            // Prevent default drag behavior on the draggable element
            draggable.addEventListener('dragstart', (e) => {
                e.preventDefault();
            });

            // Prevent propagation of the mousedown event on the input field
            inputField.addEventListener('mousedown', (e) => {
                e.stopPropagation();
            });
        });
        </script>
<form action="updateLeaderboard.php" method="POST">
            <div class="b1px gray bottom" id="draggable">
                <input type="text" placeholder="Username" id="editableInput" name="Username">
                <input type="submit">
            </div>
        </form>
</body>
</html>