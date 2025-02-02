<?php
require_once "config.php";

try {
    $sql = "SELECT * FROM graduates";
    $stmt = $pdo->query($sql);

    echo "<h2>Students List</h2>";
    echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Email</th></tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>{$row['id']}</td><td>{$row['firstName']}</td><td>{$row['lastName']}</td></tr>";
    }

    echo "</table>";
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>