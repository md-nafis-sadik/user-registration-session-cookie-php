<?php

session_start();


if (!isset($_SESSION['logged_in_user'])) {

    header("Location: login.php");
    exit();
}


$user = $_SESSION['logged_in_user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protected Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1 class="t-center" style="margin-top:80px">Welcome, <?php echo $user['username']; ?>!</h1>
    <p class="t-center">Email: <?php echo $user['email']; ?></p>
    <p class="t-center">Address: <?php echo $user['address']; ?></p>
    <p class="t-center"><a href="logout.php">Logout</a></p>
</body>
</html>
