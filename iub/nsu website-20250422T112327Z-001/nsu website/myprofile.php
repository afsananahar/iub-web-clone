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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Profile</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f2f5;
      margin: 0;
      padding: 0;
    }

    nav {
      background-color: #004080;
      padding: 12px 20px;
    }

    nav ul {
      list-style: none;
      display: flex;
      justify-content: flex-end;
    }

    nav ul li {
      margin-left: 20px;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
      font-weight: bold;
      font-size: 16px;
    }

    nav ul li a:hover {
      text-decoration: underline;
    }

    .login-container {
      max-width: 700px;
      margin: 50px auto;
      padding: 30px;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .profile-info {
      text-align: left;
      margin-top: 20px;
    }

    .profile-info p {
      font-size: 16px;
      margin: 10px 0;
      color: #333;
    }

    .home-btn {
      display: inline-block;
      margin-top: 20px;
      background-color: #2196F3;
      color: white;
      text-decoration: none;
      padding: 10px 18px;
      border-radius: 5px;
      font-size: 14px;
    }

    .home-btn:hover {
      background-color: #0b7dda;
    }
  </style>
</head>
<body>

<nav>
  <ul>
    <li><a href="index.html">Home</a></li>
    <li><a href="profile.php">My Profile</a></li>
    <li><a href="update_profile.html">Update Profile</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</nav>

<div class="login-container">
  <h2>Welcome, <?php echo htmlspecialchars($student['full_name']); ?>!</h2>
  <div class="profile-info">
    <p><strong>Student Name:</strong> <?php echo htmlspecialchars($student['full_name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?></p>
  </div>
  <a href="index.html" class="home-btn">HOME</a>
</div>

</body>
</html>
