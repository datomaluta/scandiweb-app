<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/database.php';
require_once 'classes/Database.php';
require_once 'classes/ProductFactory.php';

// Create a new instance of the Database class
$database = new Database($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['type'];

    // Create a new product using the factory
    $productFactory = new ProductFactory();
    $product = $productFactory->createProduct($type, $sku, $name, $price);

    // Get the attributes from the form data and update the product attributes
    $attributes = $_POST[$type . '-attributes'] ?? [];
    $decodedAttributes = json_decode($attributes, true);
    $product->setAttributes($decodedAttributes);


    // Save the product to the database
    $product->save($database);

    // Redirect back to the product list page
    header("Location: index.php");
    exit();
}

?>

<!-- <!DOCTYPE html>
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
            <label for="type">Product Type:</label>
            <select name="type" id="type" required>
                <option value="book">Book</option>
                <option value="dvd">DVD</option>
                <option value="furniture">Furniture</option>
            </select>
        </div>
        <div id="book-attributes" style="display: none">
            <label for="weight">Weight:</label>
            <input type="text" name="book-attributes[weight]" id="weight">
        </div>
        <div id="dvd-attributes" style="display: none">
            <label for="size">Size:</label>
            <input type="text" name="dvd-attributes[size]" id="size">
        </div>
        <div id="furniture-attributes" style="display: none">
            <label for="height">Height:</label>
            <input type="text" name="furniture-attributes[height]" id="height">
            <label for="width">Width:</label>
            <input type="text" name="furniture-attributes[width]" id="width">
            <label for="length">Length:</label>
            <input type="text" name="furniture-attributes[length]" id="length">
        </div>
        <button type="submit">Save</button>
        <a href="index.php" class="cancel-link">Cancel</a>
    </form> -->

    <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div class="wrapper">
    <div class="header">
      <h1>Add Product</h1>
      <div class="actions">
        <input form="product-form" type="submit" class="actions-btn" value="Save">
        <a href="index.php" class="cancel-link actions-btn">Cancel</a>
      </div>
    </div>
    <form method="POST" action="" id="product-form" class="form">
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
            <label for="type">Product Type:</label>
            <select name="type" id="type" required>
                <option value="book">Book</option>
                <option value="dvd">DVD</option>
                <option value="furniture">Furniture</option>
            </select>
        </div>
        <div id="book-attributes" style="display: none">
            <label for="weight">Weight (KG):</label>
            <input type="text" name="book-attributes[weight]" id="weight">
        </div>
        <div id="dvd-attributes" style="display: none">
            <label for="size">Size (MB):</label>
            <input type="text" name="dvd-attributes[size]" id="size">
        </div>
        <div id="furniture-attributes" style="display: none">
            <label for="height">Height (CM):</label>
            <input type="text" name="furniture-attributes[height]" id="height">
            <label for="width">Width (CM):</label>
            <input type="text" name="furniture-attributes[width]" id="width">
            <label for="length">Length (CM):</label>
            <input type="text" name="furniture-attributes[length]" id="length">
        </div>
        <div id="attributes-container"></div>

    </form>

    <script>
  // Show/hide attribute fields based on the selected product type
  var typeSelect = document.getElementById('type');
var attributesContainer = document.getElementById('attributes-container');
var attributeFields = {
  book: [
    { label: 'Weight', name: 'weight' }
  ],
  dvd: [
    { label: 'Size', name: 'size' }
  ],
  furniture: [
    { label: 'Height', name: 'height' },
    { label: 'Width', name: 'width' },
    { label: 'Length', name: 'length' }
  ]
};

typeSelect.addEventListener('change', function () {
  var selectedType = this.value;
  updateAttributeFields(selectedType);
});

// Update the attributes field on initial page load
updateAttributeFields(typeSelect.value);

// Update the attributes field before submitting the form
var form = document.querySelector('form');
form.addEventListener('submit', function () {
  var attributesField = document.createElement('input');
  attributesField.setAttribute('type', 'hidden');
  attributesField.setAttribute('name', typeSelect.value + '-attributes');
  attributesField.setAttribute('value', JSON.stringify(getAttributes()));
  form.appendChild(attributesField);
});

// Get the attributes from the form based on the selected product type
function getAttributes() {
  var attributes = {};
  var attributeInputs = attributesContainer.querySelectorAll('input[type="text"]');
  attributeInputs.forEach(function (input) {
    attributes[input.name] = input.value;
  });
  return attributes;
}

// Update the attribute fields based on the selected product type
function updateAttributeFields(selectedType) {
  attributesContainer.innerHTML = '';

  var attributeFieldList = attributeFields[selectedType] || [];
  attributeFieldList.forEach(function (attribute) {
    createAttributeField(attribute.label, attribute.name);
  });
}

// Create an attribute field dynamically
function createAttributeField(labelText, attributeName) {
  var label = document.createElement('label');
  label.setAttribute('for', attributeName);
  label.textContent = labelText;

  var input = document.createElement('input');
  input.setAttribute('type', 'text');
  input.setAttribute('name', attributeName);
  input.setAttribute('id', attributeName);

  attributesContainer.appendChild(label);
  attributesContainer.appendChild(input);
}

        // // Show/hide attribute fields based on the selected product type
        // var typeSelect = document.getElementById('type');
        // var bookAttributes = document.getElementById('book-attributes');
        // var dvdAttributes = document.getElementById('dvd-attributes');
        // var furnitureAttributes = document.getElementById('furniture-attributes');

        // typeSelect.addEventListener('change', function() {
        //     var selectedType = this.value;
        //     bookAttributes.style.display = selectedType === 'book' ? 'block' : 'none';
        //     dvdAttributes.style.display = selectedType === 'dvd' ? 'block' : 'none';
        //     furnitureAttributes.style.display = selectedType === 'furniture' ? 'block' : 'none';
        // });

        // // Update the attributes field before submitting the form
        // var form = document.querySelector('form');
        // form.addEventListener('submit', function() {
        //     var attributesField = document.createElement('input');
        //     attributesField.setAttribute('type', 'hidden');
        //     attributesField.setAttribute('name', typeSelect.value + '-attributes');
        //     attributesField.setAttribute('value', JSON.stringify(getAttributes()));
        //     form.appendChild(attributesField);
        // });

        // // Get the attributes from the form based on the selected product type
        // function getAttributes() {
        //     var attributes = {};
        //     if (typeSelect.value === 'book') {
        //         attributes.weight = document.getElementById('weight').value;
        //     } else if (typeSelect.value === 'dvd') {
        //         attributes.size = document.getElementById('size').value;
        //     } else if (typeSelect.value === 'furniture') {
        //         attributes.height = document.getElementById('height').value;
        //         attributes.width = document.getElementById('width').value;
        //         attributes.length = document.getElementById('length').value;
        //     }
        //     return attributes;
        // }
    </script>
    </div>
</body>
</html>
