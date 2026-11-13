<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $user, $email, $pass);
    
    if ($stmt->execute()) {
        echo "<h3 style='color:green;'>Success! User " . htmlspecialchars($user) . " created.</h3>";
    } else {
        echo "<h3 style='color:red;'>Error: " . $stmt->error . "</h3>";
    }
}
?>
<h2>Signup Page</h2>
<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Register</button>
</form>
<br>
<a href="login.php">Go to Login</a>
