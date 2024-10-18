<?php

$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
  die("Connection failed:" .$conn->connect_error);
}
echo "Connection successfully";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Создаем экземпляр Domain и передаем соединение с базой данных
    $domainModel = new Domain($conn);
    
    // Получаем данные доменов с деталями
    $domainsData = $domainModel->getWeeklyDomainsWithDetails();
    
    // Устанавливаем заголовки и возвращаем данные в формате JSON
    header('Content-Type: application/json');
    echo json_encode($domainsData);
}
