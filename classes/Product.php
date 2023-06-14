<?php

class Product
{
    private $sku;
    private $name;
    private $price;
    protected $type;
    protected $attributes;

    public function __construct($sku, $name, $price, $type, $attributes = [])
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
        $this->attributes = $attributes;
    }

    public function getSKU()
    {
        return $this->sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAttributes($attributes)
    {
        // $this->attributes = $attributes;

        if (!is_array($attributes)) {
            throw new InvalidArgumentException('Attributes must be an associative array.');
        }

        $this->attributes = $attributes;
    }

    public function save($database)
    {
        $query = "INSERT INTO products (sku, name, price, type, attributes) VALUES (:sku, :name, :price, :type, :attributes)";
        $params = [
            'sku' => $this->sku,
            'name' => $this->name,
            'price' => $this->price,
            'type' => $this->type,
            'attributes' => json_encode($this->attributes)
        ];

        $database->executeQuery($query, $params);
    }
}