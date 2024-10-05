<?php

declare(strict_types=1);

require_once "Cart.php";
require_once "Product.php";
require_once "Checkout.php";

use Cart\Cart;
use Product\Product;
use Checkout\Checkout;

$apple = new Product('apple', 20.5, 100);
$banana = new Product('banana', 30, 200);
$milk = new Product('milk', 65, 150);

try {
    $cart = new Cart();

    $cart->addItem($apple, 1);
    $cart->addItem($banana, 3);
    $cart->addItem($milk, 3);

    $checkout = new Checkout($cart);

    $checkout->finalizeOrder();
} catch (myExceptions\OutOfStockException $ex) {
    echo $ex->getMessage();
} catch (myExceptions\CartLimitExceededException $ex) {
    echo $ex->getMessage();
}