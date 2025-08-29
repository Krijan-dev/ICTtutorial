<?php
// Database connection
$servername = "localhost";
$username   = "root";   // change if different
$password   = "";       // change if you set a password
$dbname     = "week6";  // <-- updated database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect raw data
$name_raw     = $_POST['name'] ?? '';
$email_raw    = $_POST['email'] ?? '';
$message_raw  = $_POST['feedback'] ?? '';  // from form textarea (feedback)

// Check if fields are not empty
if (!empty($name_raw) && !empty($email_raw) && !empty($message_raw)) {
    // Sanitize inputs
    $name    = htmlspecialchars($name_raw);
    $email   = htmlspecialchars($email_raw);
    $message = htmlspecialchars($message_raw);

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "<h2 style='color:green;'>✅ Thank you, $name. Your message has been saved in week6 database!</h2>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Message:</strong> $message</p>";
    } else {
        echo "<h2 style='color:red;'>❌ Database Error: " . $stmt->error . "</h2>";
    }

    $stmt->close();
} else {
    echo "<h2 style='color:red;'>❌ Please fill in all fields.</h2>";
}

$conn->close();
?>
