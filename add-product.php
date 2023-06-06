<?php
require_once 'config/database.php';
require_once 'classes/Database.php';
require_once 'classes/Product.php';

// Create a new instance of the Database class
$database = new Database($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['type'];

    // Determine the attribute based on the selected product type
    $attributes = '';
    if ($type === 'book') {
        $attributes = $_POST['weight'];
    } elseif ($type === 'dvd') {
        $attributes = $_POST['size'];
    } elseif ($type === 'furniture') {
        $height = $_POST['height'];
        $width = $_POST['width'];
        $length = $_POST['length'];
        $attributes = $height . 'x' . $width . 'x' . $length;
    }

    // Create a new product object
    $product = new Product($sku, $name, $price, $type, $attributes);

    // Save the product to the database
    $query = "INSERT INTO products (sku, name, price, type, attributes) VALUES (?, ?, ?, ?, ?)";
    $parameters = [$product->getSKU(), $product->getName(), $product->getPrice(), $product->getType(), $product->getAttributes()];
    $database->executeQuery($query, $parameters);

    // Redirect back to the product list page
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Add Product</h1>
    <form method="POST" action="">
        <div>
            <label for="sku">SKU:</label>
            <input type="text" name="sku" id="sku" required>
        </div>
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" required>
        </div>
        <div>
            <label for="type">Type:</label>
            <select name="type" id="type" required>
                <option value="book">Book</option>
                <option value="dvd">DVD</option>
                <option value="furniture">Furniture</option>
            </select>
        </div>
        <div id="book-attributes" style="display: none;">
            <label for="weight">Weight:</label>
            <input type="text" name="weight" id="weight">
        </div>
        <div id="dvd-attributes" style="display: none;">
            <label for="size">Size:</label>
            <input type="text" name="size" id="size">
        </div>
        <div id="furniture-attributes" style="display: none;">
            <label for="height">Height:</label>
            <input type="text" name="height" id="height">
            <label for="width">Width:</label>
            <input type="text" name="width" id="width">
            <label for="length">Length:</label>
            <input type="text" name="length" id="length">
        </div>
        <button type="submit">Save</button>
        <a href="index.php" class="cancel-link">Cancel</a>
    </form>
<!-- 
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var typeSelect = document.getElementById('type');
        var bookAttributes = document.getElementById('book-attributes');
        var dvdAttributes = document.getElementById('dvd-attributes');
        var furnitureAttributes = document.getElementById('furniture-attributes');

        // Function to show/hide the attribute fields based on the selected product type
        function toggleAttributeFields() {
            var selectedType = typeSelect.value;

            // Hide all attribute fields by default
            bookAttributes.style.display = 'none';
            dvdAttributes.style.display = 'none';
            furnitureAttributes.style.display = 'none';

            // Show the attribute fields based on the selected product type
            if (selectedType === 'book') {
                bookAttributes.style.display = 'block';
            } else if (selectedType === 'dvd') {
                dvdAttributes.style.display = 'block';
            } else if (selectedType === 'furniture') {
                furnitureAttributes.style.display = 'block';
            }
        }

        // Add event listener to the product type select field
        typeSelect.addEventListener('change', toggleAttributeFields);

        // Trigger initial rendering of the attribute fields based on the selected product type
        toggleAttributeFields();
    });
</script> -->


    <!-- <script>
        // Show/hide attribute fields based on the selected product type
        var typeSelect = document.getElementById('type');
        var bookAttributes = document.getElementById('book-attributes');
        var dvdAttributes = document.getElementById('dvd-attributes');
        var furnitureAttributes = document.getElementById('furniture-attributes');

        typeSelect.addEventListener('change', function() {
            var selectedType = this.value;
            if (selectedType === 'book') {
                bookAttributes.style.display = 'block';
                dvdAttributes.style.display = 'none';
                furnitureAttributes.style.display = 'none';
            } else if (selectedType === 'dvd') {
                bookAttributes.style.display = 'none';
                dvdAttributes.style.display = 'block';
                furnitureAttributes.style.display = 'none';
            } else if (selectedType === 'furniture') {
                bookAttributes.style.display = 'none';
                dvdAttributes.style.display = 'none';
                furnitureAttributes.style.display = 'block';
            } else {
                bookAttributes.style.display = 'none';
                dvdAttributes.style.display = 'none';
                furnitureAttributes.style.display = 'none';
            }
        });
    </script> -->

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var typeSelect = document.getElementById('type');
        var attributeContainers = document.querySelectorAll('.attribute-container');

        // Function to show/hide the attribute fields based on the selected product type
        function toggleAttributeFields() {
            var selectedType = typeSelect.value;

            // Hide all attribute containers by default
            attributeContainers.forEach(function (container) {
                container.style.display = 'none';
            });

            // Show the attribute container for the selected product type
            var selectedAttributeContainer = document.getElementById(selectedType + '-attributes');
            if (selectedAttributeContainer) {
                selectedAttributeContainer.style.display = 'block';
            }
        }

        // Add event listener to the product type select field
        typeSelect.addEventListener('change', toggleAttributeFields);

        // Trigger initial rendering of the attribute fields based on the selected product type
        toggleAttributeFields();
    });
</script>
</body>
</html>
