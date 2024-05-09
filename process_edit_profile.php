<?php
session_start();
include("log-connection.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    // Get user_id from the session
    $user_id = $_SESSION['user_id'];

    // Collect form data
    $bio = $_POST['bio'];
    $gaming_preferences = $_POST['gaming_preferences'];

    // Upload profile image
    $profile_image_url = uploadProfileImage($user_id);

    // Update user's profile in the database
    $pdo = connect();
    $sql = "UPDATE profile_details SET bio = ?, gaming_preferences = ?, profile_image_url = ? WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$bio, $gaming_preferences, $profile_image_url, $user_id]);

    // Check if the update was successful
    if ($stmt->rowCount() > 0) {
        // Redirect to the profile page after updating
        header("Location: profile.php");
        exit;
    } else {
        // Output an error message if the update failed
        echo "Error: Profile update failed. Please try again.";
        exit;
    }
}

// Function to upload profile image and return the image URL
function uploadProfileImage($user_id) {
    // Check if a file is selected
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '/gde/upload_images'; // Update with your actual upload directory

        // Generate a unique filename to avoid overwriting
        $file_name = $user_id . '_' . basename($_FILES['profile_image']['name']);
        $target_path = $upload_dir . $file_name;

        // Move the uploaded file to the desired directory
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_path);

        // Return the image URL
        return $target_path;
    }

    return null; // Return null if no file is uploaded
}
?>
