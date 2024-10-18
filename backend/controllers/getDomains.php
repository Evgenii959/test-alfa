<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include '../config/config.php';
include '../models/Domain.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $domainModel = new Domain($db);
    
    $domainsData = $domainModel->getAllDomains();
    
    echo json_encode($domainsData);
}