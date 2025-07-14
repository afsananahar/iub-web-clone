<?php
session_start();

$host = 'localhost';
$db = 'student_portal1';
$user = 'root';
$pass = '';
$port = 3307;

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $db, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Fetch user
$stmt = $conn->prepare("SELECT * FROM students WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    
    // ✅ Compare plain text password directly
    if ($password === $row['password'])
      {
        $_SESSION['student'] = $row;
           header("Location: student_profile.php");
         header("Location: index.html");
        echo "<h3 style='text-align:center;color:green;'>✅ Login successful!</h3>";
        echo "<p style='text-align:center;'><a href='index.php'>Go to profile</a></p>";
    } else {
        echo "<h3 style='text-align:center;color:red;'>❌ Invalid password.</h3>";
    }
} else {
    echo "<h3 style='text-align:center;color:red;'>❌ No account found with that email.</h3>";
}

$stmt->close();
$conn->close();
?>