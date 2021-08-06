<?php

declare(strict_types=1);

class Product
{
    public string $name;
    public float $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function formatPrice()
    {
        return '€'. number_format($this->price, 2);
    }

};

