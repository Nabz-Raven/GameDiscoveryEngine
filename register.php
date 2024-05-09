<?php
session_start();
include("reg-connection.php");

// Initialize an empty message variable
$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $age = $_POST['age']; // Add this line to retrieve the age from the form
    $pdo = connect();

    // Check if the username already exists in the database
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $usernameCount = $stmt->fetchColumn();

    // Check if the email already exists in the database
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $emailCount = $stmt->fetchColumn();

    if (!is_numeric($username)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid email address";
        } else {
            if ($usernameCount == 0 && $emailCount == 0) {
                // Hash the password before storing it in the database
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Insert user details into the database, including age
                $sql = "INSERT into users (username, email, password, age) values (?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$username, $email, $hashedPassword, $age]);
                $userId = $pdo->lastInsertId();

                if ($userId) {
                    // Redirect to the home page upon successful registration
                    header("Location: index.php");
                    exit;
                } else {
                    $message = "Error: Something went wrong with the registration. Please try again later.";
                }
            } else {
                if ($usernameCount > 0) {
                    $message = "The username already exists. Please enter a different username";
                } else {
                    $message = "The email already exists. Please enter a different email";
                }
            }
        }
    } else {
        $message = "Numeric values for username are not acceptable";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Register to GDE</title>
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
 <nav>
      <a href="index.php">Home</a>
      <a href="about.php">About Us</a>
      <a href="contact.php">Contact</a>
      <a href="login.php">Login</a>

    </nav>


<div class="container" style="margin-bottom: 3rem; margin-top: 2rem;">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form method="POST" >
        <h2>Register</h2>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <!-- Add the age input field -->
        <div class="form-group">
          <label for="age">Age</label>
          <input type="number" class="form-control" id="age" name="age" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Register</button>
       
        <!-- Display the message underneath the form -->
        <?php if (!empty($message)) : ?>
          <p><?php echo $message; ?></p>
        <?php endif; ?>
      </form>
    </div>
  </div>
</div>

</body>

<footer>
  <p>&copy; <?php echo date("Y"); ?> Game Discovery Engine. All rights reserved.</p>
</footer>

</html>
