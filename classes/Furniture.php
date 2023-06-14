<?php

require_once 'Product.php';


// class Furniture extends Product
// {
//     protected $height;
//     protected $width;
//     protected $length;

//     public function __construct($sku, $name, $price, $height, $width, $length)
//     {
//         parent::__construct($sku, $name, $price);
//         $this->height = $height;
//         $this->width = $width;
//         $this->length = $length;
//     }

//     public function getAttributes()
//     {
//         return [
//             'dimension' => $this->height . 'x' . $this->width . 'x' . $this->length
//         ];
//     }
// }

// class Furniture extends Product
// {
//     protected $height;
//     protected $width;
//     protected $length;

//     public function __construct($sku, $name, $price, $height, $width, $length)
//     {
//         parent::__construct($sku, $name, $price, 'furniture');
//         $this->height = $height;
//         $this->width = $width;
//         $this->length = $length;
//     }

//     public function getHeight()
//     {
//         return $this->height;
//     }

//     public function getWidth()
//     {
//         return $this->width;
//     }

//     public function getLength()
//     {
//         return $this->length;
//     }

//     public function save($database)
//     {
//         parent::save($database);
//         // Additional logic specific to saving furniture
//         // For example, you can insert the furniture dimensions into a separate 'furniture' table
//         $query = "INSERT INTO furniture (sku, height, width, length) VALUES (:sku, :height, :width, :length)";
//         $params = [
//             'sku' => $this->getSKU(),
//             'height' => $this->height,
//             'width' => $this->width,
//             'length' => $this->length
//         ];

//         $database->executeQuery($query, $params);
//     }
// }

class Furniture extends Product
{
    protected $height;
    protected $width;
    protected $length;

    public function __construct($sku, $name, $price, $height, $width, $length, $attributes = [])
    {
        parent::__construct($sku, $name, $price, 'furniture', $attributes);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function getAttributes()
    {
        return [
            'height' => $this->height,
            'width' => $this->width,
            'length' => $this->length
        ];
    }
}