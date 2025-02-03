<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

$servername = "localhost";
$username = "user"; // Change if needed
$password = "password"; // Change if needed
$dbname = "Graduate_Database"; // Update this

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET': // Fetch graduate details
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $result = $conn->query("SELECT first_name, last_name, postcode FROM graduates WHERE id = $id");
            echo json_encode($result->fetch_assoc());
        } else {
            $result = $conn->query("SELECT id, first_name, last_name, postcode FROM graduates");
            echo json_encode($result->fetch_all(MYSQLI_ASSOC));
        }
        break;

    case 'POST': // Add a new graduate
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $conn->prepare("INSERT INTO graduates (first_name, last_name, postcode) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $data['first_name'], $data['last_name'], $data['postcode']);
        echo json_encode(["success" => $stmt->execute()]);
        break;

    case 'PUT': // Update graduate details
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $conn->prepare("UPDATE graduates SET first_name=?, last_name=?, postcode=? WHERE id=?");
        $stmt->bind_param("sssi", $data['first_name'], $data['last_name'], $data['postcode'], $data['id']);
        echo json_encode(["success" => $stmt->execute()]);
        break;

    case 'DELETE': // Delete a graduate
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $conn->prepare("DELETE FROM graduates WHERE id=?");
        $stmt->bind_param("i", $data['id']);
        echo json_encode(["success" => $stmt->execute()]);
        break;

    default:
        echo json_encode(["error" => "Invalid request"]);
}

$conn->close();

