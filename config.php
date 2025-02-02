<?php
// Database configuration
$host = "localhost"; // Change if your MySQL is hosted elsewhere
$dbname = "grad_database";
$username = "myuser";
$password = "mypassword";

try {
    // Create a new PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>