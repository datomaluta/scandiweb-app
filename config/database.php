<?php

$host = 'localhost';
$dbname = 'scandiweb';
$username = 'maluta';
$password = 'dato1234';

// Create a PDO instance for database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
