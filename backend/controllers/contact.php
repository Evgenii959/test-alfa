<?php
include '../config/config.php';
include '../models/Contact.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'] ?? null,
        'phone' => $_POST['phone'] ?? null,
        'email' => $_POST['email'] ?? null,
        'user_agent' => $_POST['user_agent'] ?? null,
        'device' => $_POST['device'] ?? null,
        'platform' => $_POST['platform'] ?? null,
        'visit_time' => $_POST['visit_time'] ?? null
    ];

    $contact = new Contact($data);

    if (!$contact->name || !$contact->phone) {
        echo json_encode(['error' => 'Name and phone are required']);
        exit;
    }

    $query = "INSERT INTO contacts (name, phone, email, visit_time, ip_address, user_agent, device, platform) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssss", $contact->name, $contact->phone, $contact->email, $contact->visit_time, $contact->ip_address, $contact->user_agent, $contact->device, $contact->platform);

    if ($stmt->execute()) {
        echo json_encode(['success' => 'Contact saved successfully!']);
    } else {
        echo json_encode(['error' => 'Failed to save contact']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}