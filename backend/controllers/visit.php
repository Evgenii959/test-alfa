<?php
$host = 'localhost';
$dbname = 'newdb'; 
$username = 'root';
$password = '';

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

$required_fields = ['name', 'phone', 'email', 'url', 'domain', 'userAgent', 'device', 'platform'];
foreach ($required_fields as $field) {
    if (!isset($data[$field]) || empty($data[$field])) {
        echo json_encode(['status' => 'error', 'message' => "$field is required."]);
        exit;
    }
}

$visit_time = date('Y-m-d H:i:s', strtotime(rtrim($data['visit_time'], 'Z')));

$stmt = $mysqli->prepare("INSERT INTO contacts (name, phone, email, created_at, url, visit_time, domain, user_agent, device, platform, ip_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$created_at = date('Y-m-d H:i:s'); 

$stmt->bind_param(
    "sssssssssss", 
    $data['name'],
    $data['phone'], 
    $data['email'],
    $created_at, 
    $visit_time, 
    $data['domain'],
    $data['userAgent'],
    $data['device'],
    $data['platform'], 
    $_SERVER['REMOTE_ADDR'] 
);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Visit data recorded.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to record visit data: ' . $stmt->error]);
}

$stmt->close();
$mysqli->close();
