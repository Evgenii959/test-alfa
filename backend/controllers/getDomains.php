<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include '../config/config.php';
include '../models/Domain.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Создаем экземпляр модели Domain
    $domainModel = new Domain($db);
    
    // Получаем данные о доменах
    $domainsData = $domainModel->getAllDomains();
    
    
    // Возвращаем данные в формате JSON
    echo json_encode($domainsData);
}