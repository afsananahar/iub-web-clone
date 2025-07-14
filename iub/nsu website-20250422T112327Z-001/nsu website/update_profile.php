<?php
session_start();
include 'db.php'; // This must define $conn

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: student_login.php");
    exit;
}

$user = $_SESSION['user'];
$userId = $user['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);  // plain password
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $dob = $_POST['date_of_birth'];
    $gender = $_POST['gender'];

    // Update query (no password hashing)
    $stmt = $conn->prepare("
        UPDATE users 
        SET full_name = ?, email = ?, password = ?, phone = ?, address = ?, date_of_birth = ?, gender = ?
        WHERE id = ?
    ");

    if ($stmt) {
        $stmt->bind_param("sssssssi", $full_name, $email, $password, $phone, $address, $dob, $gender, $user['id']);
        $stmt->execute();

        // Update session values (skip password for security)
        $_SESSION['user']['full_name'] = $full_name;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['phone'] = $phone;
        $_SESSION['user']['address'] = $address;
        $_SESSION['user']['date_of_birth'] = $dob;
        $_SESSION['user']['gender'] = $gender;

        header("Location: profile.php");
        exit;
    } else {
        echo "Database error: " . $conn->error;
    }
}
?>
