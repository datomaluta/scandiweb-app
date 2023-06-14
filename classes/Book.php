<?php
require_once 'Product.php';


// class Book extends Product
// {
//     protected $weight;

//     public function __construct($sku, $name, $price, $weight)
//     {
//         parent::__construct($sku, $name, $price);
//         $this->weight = $weight;
//     }

//     public function getAttributes()
//     {
//         return [
//             'weight' => $this->weight
//         ];
//     }
// }

// class Book extends Product
// {
//     protected $weight;

//     public function __construct($sku, $name, $price, $weight)
//     {
//         parent::__construct($sku, $name, $price, 'book');
//         $this->weight = $weight;
//     }

//     public function getWeight()
//     {
//         return $this->weight;
//     }

//     public function save($database)
//     {
//         parent::save($database);
//         // Additional logic specific to saving a book
//         // For example, you can insert the book's weight into a separate 'books' table
//         $query = "INSERT INTO books (sku, weight) VALUES (:sku, :weight)";
//         $params = [
//             'sku' => $this->getSKU(),
//             'weight' => $this->weight
//         ];

//         $database->executeQuery($query, $params);
//     }
// }

class Book extends Product
{
    protected $weight;

    public function __construct($sku, $name, $price, $weight, $attributes = [])
    {
        parent::__construct($sku, $name, $price, 'book', $attributes);
        $this->weight = $weight;
    }

    public function getAttributes()
    {
        return [
            'weight' => $this->weight
        ];
    }

    public function getFormattedAttributes() {
        $formattedAttributes = '';

        if (isset($this->attributes['weight'])) {
            $formattedAttributes .= 'Weight: ' . $this->attributes['weight'] . ' kg<br>';
        }

        return $formattedAttributes;
    }
}

