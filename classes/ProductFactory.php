<?php

require_once 'Book.php';
require_once 'DVD.php';
require_once 'Furniture.php';

class ProductFactory
{
    public static function createProduct($type, $sku, $name, $price, $attributes = [])
    {
        switch ($type) {
            case 'book':
                return new Book($sku, $name, $price, $attributes['weight'] ?? null);
            case 'dvd':
                return new DVD($sku, $name, $price, $attributes['size'] ?? null);
            case 'furniture':
                return new Furniture($sku, $name, $price, $attributes['height'] ?? null, $attributes['width'] ?? null, $attributes['length'] ?? null);
            default:
                throw new Exception("Invalid product type: $type");
        }
    }
}