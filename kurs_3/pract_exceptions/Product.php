<?php

use myExceptions;

class Product
{
    private string $name;
    private float $price;
    private int $stock;

    public function __construct(string $name, float $price, int $stock)
    {
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * Summary of reduceStock
     * @param int $quantity
     * @throws \myExceptions\OutOfStockException
     * @return void
     */
    public function reduceStock(int $quantity): void
    {
        if ($this->stock - $quantity < 0) {
            throw new myExceptions\OutOfStockException("Количество не может быть меньше нуля.");
        }

        $this->stock -= $quantity;
    }
}
