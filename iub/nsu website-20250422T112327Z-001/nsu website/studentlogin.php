<?php
session_start();
include 'db.php';





if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $studentid = trim($_POST['studentid']);
    $password = trim($_POST['password']);

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO users (name, email, studentid, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $studentid, $password);

    if ($stmt->execute()) {
        echo "Login/Registration successful!";
        // Redirect or load another page
        // header("Location: dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
