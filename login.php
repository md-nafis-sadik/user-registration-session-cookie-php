<?php
// Start the session
session_start();

// Initialize login error variable
$login_error = "";

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $found = false;

    // Check if the email exists in the registered users
    if (isset($_SESSION['users'])) {
        foreach ($_SESSION['users'] as $user) {
            if ($user['email'] === $email) {
                $_SESSION['logged_in_user'] = $user;
                $found = true;
                break;
            }
        }
    }

    if ($found) {
        // Redirect to protected page
        header("Location: protected_page.php");
        exit();
    } else {
        $login_error = "Invalid email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2 class="t-center">Login</h2>
    <form method="POST" action="">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <button type="submit" name="login">Login</button>
    </form>

    <?php

    if ($login_error) {
        echo "<p style='color:red;'>{$login_error}</p>";
    }
    ?>

    <p class="t-center"><a href="index.php">Back to Registration</a></p>
</body>
</html>
