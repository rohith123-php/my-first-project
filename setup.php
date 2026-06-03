<?php
require_once 'db.php';
$tables = [
    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'teacher', 'student') NOT NULL,
        reference_id INT DEFAULT NULL
    )",
    "CREATE TABLE IF NOT EXISTS students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        class_name VARCHAR(20) NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS teachers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        subject VARCHAR(50) NOT NULL
    )"
];
foreach ($tables as $query) {
    if ($conn->query($query) !== TRUE) {
        die("Error creating table: " . $conn->error);
    }
}
// Insert default admin if not exists
$checkAdmin = $conn->query("SELECT * FROM users WHERE username = 'admin'");
if ($checkAdmin->num_rows == 0) {
    $password = password_hash('admin123', PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (username, password, role) VALUES ('admin', '$password', 'admin')");
    echo "Default Admin created (username: admin, password: admin123)<br>";
}
echo "Database Setup Completed Successfully! <a href='index.php'>Go to Login</a>";
?>
