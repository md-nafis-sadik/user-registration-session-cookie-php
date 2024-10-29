<?php

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $user = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'address' => $_POST['address']
        ];

        if (!isset($_SESSION['users'])) {
            $_SESSION['users'] = [];
        }


        $_SESSION['users'][] = $user;

     
        setcookie('users', serialize($_SESSION['users']), time() + (86400 * 30), "/"); // 30 days
    }


    if (isset($_POST['delete_from_session'])) {
        $index = $_POST['delete_from_session'];
        if (isset($_SESSION['users'][$index])) {
            unset($_SESSION['users'][$index]);
            $_SESSION['users'] = array_values($_SESSION['users']);
        }
    }


    if (isset($_POST['delete_from_cookie'])) {
        $index = $_POST['delete_from_cookie'];
        if (isset($_SESSION['users'][$index])) {
            unset($_SESSION['users'][$index]);
            $_SESSION['users'] = array_values($_SESSION['users']);

            setcookie('users', serialize($_SESSION['users']), time() + (86400 * 30), "/");
        }
    }
}


if (!isset($_SESSION['users']) && isset($_COOKIE['users'])) {
    $_SESSION['users'] = unserialize($_COOKIE['users']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <nav class="navbar">
        <div class="logo">Nafis Sadik</div>
        <div class="login"><a href="login.php">Login</a></div>
    </nav>

    <div class="container">
    <div class="form-container">
    <h2 class="t-center">User Registration Form</h2>
    <form method="POST" action="">
        <label for="username">Name:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="address">Address:</label><br>
        <textarea id="address" name="address" required></textarea><br><br>

        <button type="submit" name="register">Register</button>
    </form>

    </div>

    <div class="registered-users">
    <h2 >Registered Users</h2>
    <ul class='registered'>
        <?php
        if (isset($_SESSION['users'])) {
            foreach ($_SESSION['users'] as $index => $user) {
                echo "<div>
                <div style='margin:10px 10px 5px 10px'><b>{$user['username']}</b> - {$user['email']} - {$user['address']}</div>
                <div>
                <li>
                <form method='POST' style='display:inline; box-shadow:none; padding:0px;'>
                    <input type='hidden' name='delete_from_session' value='{$index}'>
                    <button type='submit'>Delete from Session</button>
                </form>
                
                <form method='POST' style='display:inline; box-shadow:none; padding:0px;'>
                    <input type='hidden' name='delete_from_cookie' value='{$index}'>
                    <button type='submit' stylt='background:none;'>Delete from Cookie</button>
                </form>
                </div>
                </li></div>";
            }
        } else {
            echo "<li>No users registered.</li>";
        }
        ?>
    </ul>

    </div>
    </div>

</body>
</html>
