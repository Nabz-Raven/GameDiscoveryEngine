<?php include("header.php"); ?>
<?php
function connect()
{
    $username = 'root';
    $password = '';
    $host = 'localhost';
    $dbname = 'gde';
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
// Check for success or error messages and display them
$successMessage = isset($_GET['success']) ? "Thank you for your message!" : "";
$errorMessage = isset($_GET['error']) ? "There was an error processing your message. Please try again." : "";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact GDE</title>
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


         /* Add some styling for the thank you message */
        .thank-you-message {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <header>
        <h1>Contact Us </h1>
    </header>
    <nav>
        <a href="index.php">Home</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact</a>
        <?php if (isLoggedIn()): ?>
            <a href="profile.php">Profile</a>
            <a href="?logout=true">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
    <h1>Contact Us</h1>
    <section>
       <form action="process_contact.php" method="post">
        <?php if (isLoggedIn()): ?>
            <!-- Display the username and email for logged-in users -->
            <label for="name">Username:</label>
            <input type="text" id="name" name="name" value="<?php echo $_SESSION['username']; ?>" readonly>
            <?php
            // Fetch email from the database based on the username
            $pdo = connect();
            $sql = "SELECT email FROM users WHERE username = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_SESSION['username']]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = $result['email'];
            ?>
            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly>
        <?php else: ?>
            <!-- Provide input fields for non-registered users -->
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>
        <?php endif; ?>
        <label for="message">Your Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea>
        <button type="submit" name="submit">Submit</button>     
    </form>
            <!-Thank You message ->
        <?php if (!empty($successMessage)) : ?>
            <p class="thank-you-message"><?php echo $successMessage; ?></p>
        <?php elseif (!empty($errorMessage)) : ?>
            <p class="error-message"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
    </section>
</body>


<footer>
    <p>&copy;
        <?php echo date("Y"); ?> Game Discovery Engine. All rights reserved.
    </p>
</footer>
</html>