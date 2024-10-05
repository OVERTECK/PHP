<?php

declare(strict_types=1);

namespace Cart;

use myExceptions\OutOfStockException;
use myExceptions\CartLimitExceededException;
use Product\Product;

class Cart
{
    private array $items = [];
    private int $maxItems = 20;

    /**
     * Summary of addItem
     * @param \Product\Product $product
     * @param int $quantity
     * @throws \myExceptions\OutOfStockException
     * @throws \myExceptions\CartLimitExceededException
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

    public function getItems(): array
    {
        return $this->items;
    }
}
