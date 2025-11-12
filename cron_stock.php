<?php
    $host = 'localhost';
    $db = 'u761319427_igoshopguadala';
    $user = 'u761319427_igoshopguadala';
    $pass = 'M@3mq4o4+STL';
    date_default_timezone_set('America/New_York'); // Reemplaza con tu zona horaria deseada    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
        $pdo->exec("CALL sp_update_monthly_stocks()");
        echo "Stock mensual ejecutado correctamente.\n";
    } catch (PDOException $e) {
        echo "Error al ejecutar el procedimiento: " . $e->getMessage();
    }
?>
