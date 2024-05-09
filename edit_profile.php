<?php include("header.php"); ?>

<?php
// Example connection parameters
$host = 'localhost';
$dbname = 'gde';
$username = 'root';
$password = '';

// Establish the database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Now $pdo is a valid PDO object, and you can use it for database queries.
?>



<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account</title>
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

           /* Add some styling for the image */
        #profile-image {
            width: 150px; /* Adjust the size as needed */
            height: 150px;
            border-radius: 50%; /* Make it circular */
            margin: 0 auto; /* Center the image */
            display: block;
        }
        </style>  
</head>

<body>
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



<h1>Edit your Profile</h1>
  <?php include("header.php"); ?>

<form method="POST" action="process_edit_profile.php" enctype="multipart/form-data">
    <label for="bio">Bio:</label>
    <textarea id="bio" name="bio"><?php echo isset($profile_details['bio']) ? $profile_details['bio'] : ''; ?></textarea>

    <br>

    <label for="gaming_preferences">Gaming Preferences:</label>
    <input type="text" id="gaming_preferences" name="gaming_preferences" value="<?php echo isset($profile_details['gaming_preferences']) ? $profile_details['gaming_preferences'] : ''; ?>">

    <br>

    <!-- Add a new field for profile image -->
    <label for="profile_image">Profile Image:</label>
    <input type="file" id="profile_image" name="profile_image">

    <br>

    <button type="submit" name="submit">Save Changes</button>
</form>

</body>

<footer>
<p>&copy; <?php echo date("Y"); ?> Game Discovery Engine. All rights reserved.</p>
</footer>

</html>