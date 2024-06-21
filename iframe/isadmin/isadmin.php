<?php
$config = require("../../config.php");

$sUser = $config['user'];
$sDb = $config['name'];
$sPass = $config['pass'];
$sHost = $config['host'];

$conn = new mysqli($sHost, $sUser, $sPass, $sDb);
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
        .b1px{
            border: 1px solid black;
            width: fit-content;
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
        .m5{
            margin-top: 5px;
            margin-bottom: 5px;
        }
        .ml15{
            margin-left: 15px;
        }
    </style>
</head>
<body>
    <h2>Users:</h2>
    <div class="ml15">
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
        <ul>
            <?php
                $stmt = $conn->query("SELECT Username, IsAdmin FROM users");
                $stmt->fetch_assoc();
                while ($row = $stmt->fetch_assoc()) {
                    if (htmlspecialchars($row['IsAdmin']) == 0) {
                        echo "<li class='m5'>" . htmlspecialchars($row['Username']) . " -- IsAdmin: No" . "</li>";
                    } else if(htmlspecialchars($row['IsAdmin']) == 1) {
                        echo "<li class='m5'>" . htmlspecialchars($row['Username']) . " -- IsAdmin: Yes" . "</li>";
                    }
                }
                $stmt->close();
                $conn->close();
            ?>
        </ul>
        <form action="updateAdmin.php" method="POST">
            <div class="b1px gray bottom" id="draggable">
                <input type="text" placeholder="Username" id="editableInput" name="Username"><br>
                <label for="isAdmin">Admin:</label>
                <input type="checkbox" name="isAdmin"><br>
                <input type="submit">
            </div>
        </form>
    </div>
</body>
</html>