<?php
define('DB_HOST', 'localhost'); 
define('DB_NAME', 'event');
define('DB_USER', 'root');
define('DB_PASS', '');
try {
    $db = new PDO('mysql:host=' . DB_HOST. ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
}catch (PDOException $e) {
    
    echo 'une erreur est survenue';
    die();
}








?>