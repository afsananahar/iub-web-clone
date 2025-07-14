<?php
// Turn on error display for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$host = '127.0.0.1';     // or 'localhost'
$user = 'root';
$pass = '';
$db   = 'student_portal1';
$port = 3307;            // 👈 Custom port here

// Connect to MySQL on custom port
$conn = new mysqli($host, $user, $pass, $db, $port);

// Check connection
if ($conn->connect_error) {
    die("<h3 style='color:red;text-align:center;'>❌ Database connection failed: " . $conn->connect_error . "</h3>");
}

// Process POST form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form inputs
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];

    // Basic validation
    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "<h3 style='color:red;text-align:center;'>❌ Please fill in all required fields.</h3>";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "<h3 style='color:red;text-align:center;'>❌ Passwords do not match.</h3>";
        exit;
    }

    // Check for duplicate email
    $check = $conn->prepare("SELECT id FROM students WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<h3 style='color:red;text-align:center;'>❌ Email already exists.</h3>";
        $check->close();
        exit;
    }
    $check->close();

    // Hash password securely
  // Store plain text password (NOT SECURE, for demo only)
$hashed_password = $password;


    // Insert into database
    $stmt = $conn->prepare("INSERT INTO students (full_name, email, password, phone, address, date_of_birth, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $full_name, $email, $hashed_password, $phone, $address, $date_of_birth, $gender);

    if ($stmt->execute()) {
        echo "<h3 style='color:green;text-align:center;'>✅ Registration successful!</h3>";
        echo "<p style='text-align:center;'><a href='student_login.html'>Click here to login</a></p>";
    } else {
        echo "<h3 style='color:red;text-align:center;'>❌ Error: " . $stmt->error . "</h3>";
    }

    $stmt->close();
}

$conn->close();
?>
