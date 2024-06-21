<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Woordle</title>
    <link rel="stylesheet" href="src/css/main.css">
    <style>
        svg path {
            animation: moveRight 30s linear forwards;
            opacity: .5;
        }
        svg {
            position: relative;
            pointer-events: none
        }
        @keyframes moveRight {
            0% {
                transform: translateX(-150vw);
            }
            100% {
                transform: translateX(120vw);
            }
        }
    </style>
</head>
<body>
<div class="alert"></div>
    <div class="centering">
        <h1 class="FS64">Wordle</h1>
        <div id="container"></div>
        <div class="MTop15">
            <input type="text" id="textInput">
            <button id="submitButton">raden</button>
        </div>
        <script type="module" src="app.js"></script>
    </div>
<?php
session_start();
    if (isset($_SESSION['Username'])) {
        $Username = $_SESSION['Username'];
        echo "<p class='Tright'> Welcome " . $Username . "!</p><br>";
        echo "<button class='Trightl'><a href='pages/logout.php'>Logout</a></button>";
    } else {
        echo '<div class="Tright">
        <a href="pages/login.php">
            <button>
                Login
            </button>
        </a>
        <p class="M0">or</p>
            <a href="pages/register.php">
                <button>
                    register
                </button>
            </a>
        </div>';
    }
?>
<div class="Tleft">
    <?php
        if(isset($_SESSION['IsAdmin'])){
            $IsAdmin = $_SESSION['IsAdmin'];
            if($IsAdmin == 1){
                echo "<a href='pages/dashboard.php'>Dashboard</a>";
            }
        }
    ?>
</div>
<div id="draggable">
        <?php
        $config = include('config.php');

        $sUser = $config['user'];
        $sDb = $config['name'];
        $sPass = $config['pass'];
        $sHost = $config['host'];

        $conn = new mysqli($sHost, $sUser, $sPass, $sDb);
        $leaderboard = $conn->prepare('SELECT Username, CorrectGuesses FROM users WHERE IsAdmin=0 ORDER BY CorrectGuesses DESC LIMIT 10');
        $leaderboard->execute();
        $leaderboard->bind_result($Username, $CorrectGuesses);

        echo "<table>";
        echo "<tr><th class='br1'>Username</th><th>CorrectGuesses</th></tr>";
        while($leaderboard->fetch()) {
            echo "<tr><td class='br1'>$Username</td><td>$CorrectGuesses</td></tr>";
        }
        echo "</table>";
        ?>
    </div>
    <div id="clouds"></div>
    <script>
        const svg = `<svg width="1603" height="651" viewBox="0 0 1603 651" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M1342.09 184.148C1317.68 176.36 1300 153.494 1300 126.5C1300 93.0868 1327.09 66 1360.5 66C1363.35 66 1366.16 66.1973 1368.9 66.5791C1379.32 48.3143 1398.97 36 1421.5 36C1432.62 36 1443.04 39.0017 1452 44.2392C1460.96 39.0017 1471.38 36 1482.5 36C1510.92 36 1534.76 55.5956 1541.25 82.0126C1541.67 82.0042 1542.08 82 1542.5 82C1575.91 82 1603 109.087 1603 142.5C1603 175.913 1575.91 203 1542.5 203C1542 203 1541.5 202.994 1541 202.982C1534.16 228.895 1510.56 248 1482.5 248C1467.17 248 1453.16 242.295 1442.5 232.891C1431.84 242.295 1417.83 248 1402.5 248C1369.09 248 1342 220.913 1342 187.5C1342 186.375 1342.03 185.258 1342.09 184.148Z" fill="white"/>
        <path d="M1342.09 184.148L1343.09 184.203L1343.13 183.431L1342.4 183.196L1342.09 184.148ZM1368.9 66.5791L1368.77 67.5696L1369.44 67.6628L1369.77 67.0744L1368.9 66.5791ZM1452 44.2392L1451.5 45.1024L1452 45.3977L1452.5 45.1024L1452 44.2392ZM1541.25 82.0126L1540.28 82.2512L1540.47 83.0285L1541.27 83.0124L1541.25 82.0126ZM1541 202.982L1541.03 201.982L1540.24 201.963L1540.03 202.727L1541 202.982ZM1442.5 232.891L1443.16 232.141L1442.5 231.558L1441.84 232.141L1442.5 232.891ZM1342.4 183.196C1318.39 175.535 1301 153.047 1301 126.5H1299C1299 153.942 1316.97 177.184 1341.79 185.101L1342.4 183.196ZM1301 126.5C1301 93.6391 1327.64 67 1360.5 67V65C1326.53 65 1299 92.5345 1299 126.5H1301ZM1360.5 67C1363.31 67 1366.07 67.1941 1368.77 67.5696L1369.04 65.5886C1366.25 65.2005 1363.4 65 1360.5 65V67ZM1369.77 67.0744C1380.02 49.1089 1399.34 37 1421.5 37V35C1398.6 35 1378.62 47.5197 1368.04 66.0838L1369.77 67.0744ZM1421.5 37C1432.44 37 1442.69 39.9521 1451.5 45.1024L1452.5 43.376C1443.4 38.0514 1432.81 35 1421.5 35V37ZM1452.5 45.1024C1461.31 39.9521 1471.56 37 1482.5 37V35C1471.19 35 1460.6 38.0514 1451.5 43.376L1452.5 45.1024ZM1482.5 37C1510.45 37 1533.9 56.2708 1540.28 82.2512L1542.23 81.7739C1535.63 54.9204 1511.39 35 1482.5 35V37ZM1541.27 83.0124C1541.68 83.0041 1542.09 83 1542.5 83V81C1542.08 81 1541.66 81.0043 1541.23 81.0128L1541.27 83.0124ZM1542.5 83C1575.36 83 1602 109.639 1602 142.5H1604C1604 108.534 1576.47 81 1542.5 81V83ZM1602 142.5C1602 175.361 1575.36 202 1542.5 202V204C1576.47 204 1604 176.466 1604 142.5H1602ZM1542.5 202C1542.01 202 1541.52 201.994 1541.03 201.982L1540.98 203.982C1541.48 203.994 1541.99 204 1542.5 204V202ZM1540.03 202.727C1533.31 228.211 1510.1 247 1482.5 247V249C1511.03 249 1535.02 229.578 1541.97 203.237L1540.03 202.727ZM1482.5 247C1467.42 247 1453.65 241.39 1443.16 232.141L1441.84 233.641C1452.68 243.2 1466.91 249 1482.5 249V247ZM1441.84 232.141C1431.35 241.39 1417.58 247 1402.5 247V249C1418.09 249 1432.32 243.2 1443.16 233.641L1441.84 232.141ZM1402.5 247C1369.64 247 1343 220.361 1343 187.5H1341C1341 221.466 1368.53 249 1402.5 249V247ZM1343 187.5C1343 186.394 1343.03 185.294 1343.09 184.203L1341.09 184.094C1341.03 185.222 1341 186.357 1341 187.5H1343Z" fill="black" mask="url(#path-1-inside-1_15_3)"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M1110.09 547.148C1085.68 539.36 1068 516.494 1068 489.5C1068 456.087 1095.09 429 1128.5 429C1131.35 429 1134.16 429.197 1136.9 429.579C1147.32 411.314 1166.97 399 1189.5 399C1200.62 399 1211.04 402.002 1220 407.239C1228.96 402.002 1239.38 399 1250.5 399C1278.92 399 1302.76 418.596 1309.25 445.013C1309.67 445.004 1310.08 445 1310.5 445C1343.91 445 1371 472.087 1371 505.5C1371 538.913 1343.91 566 1310.5 566C1310 566 1309.5 565.994 1309 565.982C1302.16 591.895 1278.56 611 1250.5 611C1235.17 611 1221.16 605.295 1210.5 595.891C1199.84 605.295 1185.83 611 1170.5 611C1137.09 611 1110 583.913 1110 550.5C1110 549.375 1110.03 548.258 1110.09 547.148Z"/>
        </svg>`

        const clouds = document.getElementById("clouds");

        function appendRandomSVG() {
            const randomSVG = svg;
            const cloudContainer = clouds
            const divElement = document.createElement("div");
            divElement.style.position = "absolute";
            divElement.style.top = Math.random() * 500 + "px";
            divElement.style.pointerEvents = "none"
            divElement.innerHTML = randomSVG;

            document.body.appendChild(divElement);

            setTimeout(() => {
                divElement.remove();
            }, 30000);
        }

        appendRandomSVG()
        const intervalId = setInterval(appendRandomSVG, 5000);
                

    </script>
    
</body>
</html>