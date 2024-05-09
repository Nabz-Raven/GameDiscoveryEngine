<?php
session_start();
include("log-connection.php"); // Adjust the include path as needed
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $pdo = connect();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    // Simple validation
    if (empty($name) || empty($email) || empty($message)) {
        // Handle validation error
        header("Location: contact.php?error=1");
        exit;
    }
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Handle validation error
        header("Location: contact.php?error=2");
        exit;
    }
    // Insert data into the contacts table
    $sql = "INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $message]);
    // Redirect to the contact page with a success message
    header("Location: contact.php?success=1");
    exit;
} else {
    // Redirect to the contact page if accessed directly without form submission
    header("Location: contact.php");
    exit;
}
?>
