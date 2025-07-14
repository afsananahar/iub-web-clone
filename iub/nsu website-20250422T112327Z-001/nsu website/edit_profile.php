<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: student_login.html");
    exit();
}

$student = $_SESSION['user'];

$host = 'localhost';
$dbname = 'student_portal1';
$username = 'root';
$password = '';
$port = 3307;

$conn = new mysqli($host, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $student_id = $student['student_id'];

    $stmt = $conn->prepare("UPDATE students SET full_name=?, phone=?, gender=?, address=? WHERE student_id=?");
    $stmt->bind_param("ssssi", $full_name, $phone, $gender, $address, $student_id);
    $stmt->execute();

    // Update session data
    $_SESSION['student']['full_name'] = $full_name;
    $_SESSION['student']['phone'] = $phone;
    $_SESSION['student']['gender'] = $gender;
    $_SESSION['student']['address'] = $address;

    header("Location: profile.php");
    exit();
}
?>


