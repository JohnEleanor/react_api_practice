<?php 
$DB_SERVER = '127.0.0.1';
$DB_USERNAME = 'root';
$DB_PASSWORD = '';
$DB_DATABASE_NAME = 'postman';

try {
    $dns = "mysql:host=$DB_SERVER;dbname=$DB_DATABASE_NAME;charset=utf8mb4";
    $conn = new PDO($dns, $DB_USERNAME, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>