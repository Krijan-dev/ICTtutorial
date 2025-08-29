<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "week6");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Collect form data
$name    = $_POST['name'] ?? '';
$email   = $_POST['email'] ?? '';
$message = $_POST['feedback'] ?? '';

// Insert into database if all fields are filled
if ($name && $email && $message) {
    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    $stmt->execute();
    $stmt->close();
    echo "Message saved successfully!";
} else {
    echo "Please fill in all fields.";
}

$conn->close();
?>
