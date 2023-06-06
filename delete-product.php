<?php
require_once 'config/database.php';
require_once 'classes/Database.php';

// Create a new instance of the Database class
$database = new Database($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mass-delete'])) {
    $productIds = $_POST['delete'];
    
    foreach ($productIds as $productId) {
        $query = "DELETE FROM products WHERE id = ?";
        $parameters = [$productId];
        $database->executeQuery($query, $parameters);
    }

    header("Location: index.php");
    exit();
}