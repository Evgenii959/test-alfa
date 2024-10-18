<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');

include '../config/config.php'; 
include '../models/Contact.php';

try {
    $query = "SELECT * FROM contacts";
    $result = $conn->query($query);

    if (!$result) {
        throw new Exception("Ошибка выполнения запроса: " . $conn->error);
    }

    $contacts = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $contacts[] = new Contact($row);
        }
    }

    echo json_encode($contacts);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}