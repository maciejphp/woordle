<?php
error_reporting(0);
 if($_POST['err'] == 1){
    echo "<script>alert('Invalid Username or Password!');</script>";
} else if($_POST['err'] == 2){
    echo "<script>alert('Invalid characters in username!');</script>";
}
?>
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
        <div class="container">
            <form action="checking.php" method="POST">
                <h2>Log in:</h2>
                <label for="user"><span class="red">*</span>Username:</label>
                <input type="text" id="user" placeholder="Username" name="Username" required minlength="3" maxlength="45">
                <label for="email">Email:</label>
                <input type="email" id="email" name="Email" placeholder="Email">
                <label for="pass"><span class="red">*</span>Password:</label>
                <input type="password" id="pass" name="Password" placeholder="password" required minlength="6">
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
</body>
</html>