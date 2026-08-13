<?php
// 1. DATABASE CONFIGURATION
$host = "localhost";
$username = "root";
$password = "root"; 
$dbname = "studentstudyhub_db";

// Connect to MySQLi
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}

// 2. PROCESS FORM SUBMISSION (POST METHOD)
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = htmlspecialchars($_POST['fullname'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $gender = htmlspecialchars($_POST['gender'] ?? '');
    $subject = htmlspecialchars($_POST['subject'] ?? '');

    if (!empty($fullname) && !empty($email)) {
        $stmt = $conn->prepare("INSERT INTO submissions (fullname, email, gender, subject) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullname, $email, $gender, $subject);
        
        if ($stmt->execute()) {
            $msg = "Success! Data successfully saved to the database.";
        } else {
            $msg = "Error saving data: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $msg = "Please fill in all required fields.";
    }
}

// 3. RETRIEVE ALL RECORDS FROM DATABASE
$sql = "SELECT fullname, email, gender, subject, submitted_at FROM submissions ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Database Records Dashboard</title>
    <style>
        body { font-family: sans-serif; background: #f0f2f5; margin: 0; padding: 20px; }
        .db-container { max-width: 800px; margin: 30px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .alert { padding: 12px; margin-bottom: 20px; border-radius: 4px; font-weight: bold; background: #e1f5fe; color: #0288d1; text-align: center; }
        .data-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .data-table th, .data-table td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        .data-table th { background-color: #0288d1; color: white; }
        .back-btn { display: inline-block; margin-bottom: 15px; color: #0288d1; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="db-container">
    <h2>Submission Status Dashboard</h2>
    
    <?php if (!empty($msg)): ?>
        <div class="alert"><?php echo $msg; ?></div>
    <?php endif; ?>

    <a class="back-btn" href="contact.html">← Return to Contact Form</a>

    <h3>All Submitted Database Records</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Subject</th>
                <th>Date & Time</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["fullname"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["gender"] . "</td>";
                    echo "<td>" . $row["subject"] . "</td>";
                    echo "<td>" . $row["submitted_at"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found in the database yet.</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
