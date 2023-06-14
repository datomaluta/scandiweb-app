<?php

require_once 'Product.php';


// class DVD extends Product
// {
//     protected $size;

//     public function __construct($sku, $name, $price, $size)
//     {
//         parent::__construct($sku, $name, $price);
//         $this->size = $size;
//     }

//     public function getAttributes()
//     {
//         return [
//             'size' => $this->size
//         ];
//     }
// }

// class DVD extends Product
// {
//     protected $size;

//     public function __construct($sku, $name, $price, $size)
//     {
//         parent::__construct($sku, $name, $price, 'dvd');
//         $this->size = $size;
//     }

//     public function getSize()
//     {
//         return $this->size;
//     }

//     public function save($database)
//     {
//         parent::save($database);
//         // Additional logic specific to saving a DVD
//         // For example, you can insert the DVD's size into a separate 'dvds' table
//         $query = "INSERT INTO dvds (sku, size) VALUES (:sku, :size)";
//         $params = [
//             'sku' => $this->getSKU(),
//             'size' => $this->size
//         ];

//         $database->executeQuery($query, $params);
//     }
// }

class DVD extends Product
{
    protected $size;

    public function __construct($sku, $name, $price, $size, $attributes = [])
    {
        parent::__construct($sku, $name, $price, 'dvd', $attributes);
        $this->size = $size;
    }

    public function getAttributes()
    {
        return [
            'size' => $this->size
        ];
    }
}