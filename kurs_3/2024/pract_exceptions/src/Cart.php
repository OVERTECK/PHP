<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\OutOfStockException;
use App\Exceptions\CartLimitExceededException;
use App\Product;

class Cart
{
    /**
     * Summary of items
     *
     * @var array<Product>
     */
    private array $items = [];
    private int $maxItems = 20;

    /**
     * Summary of addItem
     * @param \App\Product $product
     * @param int $quantity
     * @throws \App\Exceptions\OutOfStockException
     * @throws \App\Exceptions\CartLimitExceededException
     * @return void
     */
    public function addItem(Product $product, int $quantity): void
    {
        if ($product->getStock() < $quantity) {
            throw new OutOfStockException("Запрашиваемое количество больше количества товара.");
        }

        if (count($this->items) + $quantity > $this->maxItems) {
            throw new CartLimitExceededException("Превышение максимального количества товаров в корзине.");
        }

        for ($i = 0; $i < $quantity; $i++) {
            $this->items[] = $product;
        }
    }

    public function removeItem(Product $product): void
    {
        $arrItems = $this->getItems();

        foreach ($arrItems as $key => $item) {

            if ($item === $product) {
                unset($this->items[$key]);

                break;
            }
        }
    }

    public function getTotal(): float
    {
        $resultSum = 0;

        $arrItems = $this->getItems();

        foreach ($arrItems as $value) {
            $resultSum += $value->getPrice();
        }

        return $resultSum;
    }

    /**
     * Summary of getItems
     *
     * @return array<Product>
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
