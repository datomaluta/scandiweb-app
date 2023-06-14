<?php
require_once 'config/database.php';
require_once 'classes/Database.php';
require_once 'classes/Product.php';

// Create a new instance of the Database class
$database = new Database($pdo);

// Fetch all products from the database
$query = "SELECT * FROM products";
$products = $database->fetchAll($query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <div class="wrapper">
    <div class="header">
        <h1>Product List</h1>
        <div class="actions">
            <a href="add-product.php" class="actions-btn add-link">Add</a>
            <input type="submit" value="Mass Delete" name="mass-delete" class="actions-btn delete-button" form="delete-form">
        </div> 
    </div>
    <form id="delete-form" action="delete-product.php" method="POST" class="form">
        <div class="container">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <input type="checkbox" name="delete[]" value="<?php echo $product['id']; ?>" class="delete-checkbox">
                <div class="product-content">
                    <p><?php echo $product['sku']; ?></p>
                    <p><?php echo $product['name']; ?></p>
                    <p>$<?php echo $product['price']; ?></p>
                    <?php
                    $attributes = json_decode($product['attributes'], true);
                    if ($product['type'] === 'book' && isset($attributes['weight'])):
                    ?>
                        <p><?php echo $attributes['weight']; ?> kg</p>
                    <?php elseif ($product['type'] === 'dvd' && isset($attributes['size'])): ?>
                        <p><?php echo $attributes['size']; ?> MB</p>
                    <?php elseif ($product['type'] === 'furniture' && isset($attributes['height']) && isset($attributes['width']) && isset($attributes['length'])): ?>
                        <p><?php echo $attributes['height']; ?> x <?php echo $attributes['width']; ?> x <?php echo $attributes['length']; ?> cm</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
       
    </form>
    </div>
</body>
</html>
