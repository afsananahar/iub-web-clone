<?php
session_start();
if (!isset($_SESSION['student'])) {
    header("Location: student_login.html");
    exit();
}

$student = $_SESSION['student'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Profile</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .profile-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            max-width: 600px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .profile-info p {
            font-size: 16px;
            margin: 10px 0;
        }

        .logout-btn {
            display: block;
            margin-top: 20px;
            background-color: #d9534f;
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>Welcome, <?php echo htmlspecialchars($student['full_name']); ?>!</h2>
        <div class="profile-info">
            <p><strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($student['phone']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($student['address']); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($student['date_of_birth']); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($student['gender']); ?></p>
        </div>
        <a class="logout-btn" href="logout.php">Logout</a>
    </div>
</body>
</html>
