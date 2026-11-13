<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        if (password_verify($pass, $row['password'])) {
            $_SESSION['user'] = $user;
            echo "<h3 style='color:green;'>Login successful! Welcome, " . htmlspecialchars($user) . ".</h3>";
        } else {
            echo "<h3 style='color:red;'>Invalid password.</h3>";
        }
    } else {
        echo "<h3 style='color:red;'>User not found.</h3>";
    }
}
?>
<h2>Login Page</h2>
<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>
<br>
<a href="signup.php">Go to Signup</a>
