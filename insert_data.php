<?php
require_once "config.php";

try {
    // Sample SQL insert statement
    $sql = "INSERT INTO graduates (firstName, lastName) VALUES (:firstName, :lastName)";
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);

    // Example values
    $firstName = "John Doe";
    $lastName = "johndoe@example.com";

    // Execute the query
    $stmt->execute();

    echo "Record inserted successfully!";
} catch (PDOException $e) {
    die("Error inserting data: " . $e->getMessage());
}
?>