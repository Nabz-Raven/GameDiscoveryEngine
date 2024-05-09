<?php
// Check if the session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("log-connection.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Initialize $profile_details
$profile_details = null;

// Check if 'user_id' is set in the session
if (isset($_SESSION['user_id'])) {
    // Fetch user details from the database
    $pdo = connect();
    $sql = "SELECT * FROM profile_details WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $profile_details = $stmt->fetch(PDO::FETCH_ASSOC);


// Check if the user has a profile image
if ($profile_details && isset($profile_details['profile_image_url'])) {
    $profile_image_url = $profile_details['profile_image_url'];
    // Display the profile image
    echo '<img src="' . $profile_image_url . '" alt="Profile Image">';
} else {
    // Display a default profile image or a placeholder
    echo '<img src="gde/default_profile_image.jpg" alt="Default Profile Image">';
}
}
?>

<?php include("header.php"); ?>

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



<h1>Profile</h1>

    <section>
        <?php if ($profile_details && isset($profile_details['profile_image_url'])): ?>
            <!-- Display the profile image if available -->
            <img id="profile-image" src="<?php echo $profile_details['profile_image_url']; ?>" alt="Profile Image">
        <?php else: ?>
            <!-- Display a default image if no profile image is available -->
            <img id="profile-image" src="/gde/default_profile_image.jpg" alt="Default Profile Image">
        <?php endif; ?>
    </section>

<section>

        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>

        <?php if ($profile_details) : ?>
    
            <p>Bio: <?php echo $profile_details['bio']; ?></p>

        <?php else : ?>
            <p>You haven't set up your profile yet. <a href="edit_profile.php">Edit Profile</a></p>
        <?php endif; ?>

    </section>

<div>
    <?php
    if ($profile_details && isset($profile_details['bio'])) {
        echo '<p>' . $profile_details['bio'] . '</p>';
    } else {
        echo '<p><H2>Bio</H2>No bio available.</p>';
    }
    ?>
</div>






</body>

<footer>
<p>&copy; <?php echo date("Y"); ?> Game Discovery Engine. All rights reserved.</p>
</footer>
</html>