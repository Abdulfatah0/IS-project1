<?php
require 'config.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $message = $_POST['message'];
    
    $stmt = $conn->prepare("INSERT INTO feedback (name, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $message);
    
    if ($stmt->execute()) {
        echo "<h3 style='color:green;'>Feedback submitted successfully!</h3>";
    } else {
        echo "<h3 style='color:red;'>Error: " . $stmt->error . "</h3>";
    }
}
?>
<h2>Submit Feedback</h2>
<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Message: <textarea name="message" required></textarea><br><br>
    <button type="submit">Submit</button>
</form>

<hr>
<h2>Retrieved Feedback</h2>
<?php
// Retrieve data from the table
$result = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>" . htmlspecialchars($row['name']) . ":</strong> " . htmlspecialchars($row['message']) . " <em>(" . $row['submitted_at'] . ")</em></p>";
    }
} else {
    echo "<p>No feedback submitted yet.</p>";
}
?>
<br>
<a href="login.php">Back to Login</a>
