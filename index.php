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
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Product List</h1>

    <form action="delete-product.php" method="POST">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <input type="checkbox" name="delete[]" value="<?php echo $product['id']; ?>" class="delete-checkbox">
                <h2><?php echo $product['name']; ?></h2>
                <p>SKU: <?php echo $product['sku']; ?></p>
                <p>Price: $<?php echo $product['price']; ?></p>
                <?php if ($product['type'] === 'book'): ?>
                    <p>Weight: <?php echo $product['attributes']; ?> kg</p>
                <?php elseif ($product['type'] === 'dvd'): ?>
                    <p>Size: <?php echo $product['attributes']; ?> MB</p>
                <?php elseif ($product['type'] === 'furniture'): ?>
                    <?php
                    $dimensions = explode('x', $product['attributes']);
                    $height = $dimensions[0];
                    $width = $dimensions[1];
                    $length = $dimensions[2];
                    ?>
                    <p>Dimensions: <?php echo $height; ?>x<?php echo $width; ?>x<?php echo $length; ?> cm</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <button type="submit" name="mass-delete">Mass Delete</button>
    </form>

    <a href="add-product.php" class="add-link">Add Product</a>
</body>
</html>