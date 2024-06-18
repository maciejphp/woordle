<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="../src/css/login.css">
</head>
<body>
    <div class="C1">
        <div class="container3">
            <form action="registratie.php" method="POST">
                <h2>Register:</h2>
                <label for="user"><span class="red">*</span>Username:</label>
                <input type="text" id="user" name="Username" placeholder="Username" required>
                <div class="Fwidth">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Email">
                    <label for="email2">Retype Email:</label>
                    <input type="email" name="email2" placeholder="Retype Email">
                </div>
                <div class="Fwidth">
                    <label for="pass"><span class="red">*</span>Password:</label>
                    <input type="password" name="Password" id="pass" placeholder="password" required minlength="6">
                    <label for="pass2"><span class="red">*</span>Retype Password:</label>
                    <input type="password" name="pass2" id="pass2" placeholder="Retype password" required minlength="6">
                </div>
                <input type="submit" value="Register">
            </form>
        </div>
    </div>
</body>
</html>