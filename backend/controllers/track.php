<?php
header('Content-Type: application/json');
require_once '../config/config.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'unknown';
$ip = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];

$response = [
    'success' => true,
    'message' => 'Visit tracked successfully.',
];

echo json_encode($response);