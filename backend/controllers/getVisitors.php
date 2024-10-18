<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once '../config/config.php'; 
include '../models/Visitor.php';

$host = 'localhost';
$dbname = 'newdb';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $visitorModel = new Visitor($db);
    $visitorsData = $visitorModel->getAllVisitors();
    echo json_encode($visitorsData);
}