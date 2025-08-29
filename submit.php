<?php
// Database connection settings
$servername = "localhost";   // usually localhost
$username   = "root";        // your DB username
$password   = "";            // your DB password
$dbname     = "contact_form"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect and sanitize form data
$name     = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$email    = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$feedback = isset($_POST['feedback']) ? htmlspecialchars($_POST['feedback']) : '';

// Insert into database
if (!empty($name) && !empty($email) && !empty($feedback)) {
    $stmt = $conn->prepare("INSERT INTO messages (name, email, feedback) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $feedback);

    if ($stmt->execute()) {
        echo "<h2 style='color:green;'>✅ Thank you, $name. Your message has been saved!</h2>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Message:</strong> $feedback</p>";
    } else {
        echo "<h2 style='color:red;'>❌ Error: " . $stmt->error . "</h2>";
    }

    $stmt->close();
} else {
    echo "<h2 style='color:red;'>❌ Please fill in all fields.</h2>";
}

$conn->close();
?>
