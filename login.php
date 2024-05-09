<?php
session_start();
include("log-connection.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pdo = connect();
    // Check if the username is numeric
    if (!is_numeric($username)) {
        // Check accounts table for login using prepared statement
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $account_row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($account_row) {
            // Verify hashed password
            if (password_verify($password, $account_row['password'])) {
                $_SESSION['username'] = $account_row['username'];
                $_SESSION['role'] = $account_row['role'];
                if ($account_row['role'] == 'user') {
                    header("Location: index.php");
                    die;
                } else if ($account_row['role'] == 'staff') {
                    header("Location: Dash.php");
                    die;
                }
            } 
        }
    } 
}
// Redirect logged-in users to Homepage.php
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav {
            background-color: #444;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 0 10px;
        }

        section {
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
<header>
    <h1>Login</h1>
</header>

  <nav>
      <a href="index.php">Home</a>
      <a href="about.php">About Us</a>
      <a href="contact.php">Contact</a>
      <a href="login.php">Login</a>
    </nav>

<!-- Login Form -->
<br>
<form action="login.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit"><?php echo isset($_SESSION['username']) ? 'Logout' : 'Login'; ?></button>
        <br>
           <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (!isset($_SESSION['username'])) {
            echo "<p style='color: red;'>Invalid username or password</p>";
        }
    }
    ?>
    <!-- Register Button -->
    <a href="register.php" class="register-button">Register</a>
</form>
<!-- Optional: Add some styling for the register button -->
<style>
    .register-button {
        display: inline-block;
        margin-top: 10px;
        padding: 8px 15px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .register-button:hover {
        background-color: #45a049;
    }

</style>
 </body>
<footer>
    <p>&copy; <?php echo date("Y"); ?> Game Discovery Engine. All rights reserved.</p>
</footer>
</html>
