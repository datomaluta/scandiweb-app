<?php

class Product {
    private $sku;
    private $name;
    private $price;
    private $type;
    private $attributes;

    public function __construct($sku, $name, $price, $type, $attributes) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
        $this->attributes = $attributes;
    }

    public function getSKU() {
        return $this->sku;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getType() {
        return $this->type;
    }

    public function getAttributes() {
        return $this->attributes;
    }
}
