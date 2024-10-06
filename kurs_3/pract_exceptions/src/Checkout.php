<?php

declare(strict_types=1);

namespace Checkout;

require_once 'vendor\\autoload.php';

use Cart\Cart;
use myExceptions\CartLimitExceededException;
use myExceptions\InsufficientFundsException;
use myExceptions\OutOfStockException;
use myExceptions\PaymentGatewayException;

class Checkout
{
    private Cart $cart;
    private string $paymentMethod = 'credit card';
    private float $userBalance = 200;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function setPaymentMethod(string $method): void
    {
        $this->paymentMethod = $method;
    }

    /**
     * Summary of processPayment
     *
     * @param  float $amount
     * @throws \myExceptions\PaymentGatewayException
     * @throws \myExceptions\InsufficientFundsException
     * @return void
     */
    public function processPayment(float $amount): void
    {
        $method = $this->paymentMethod;

        switch ($method) {
        case 'credit card':
            break;
        default:
            throw new PaymentGatewayException('Данный способ оплаты не найден.');
        }

        if ($amount > $this->userBalance) {
            throw new InsufficientFundsException("Баланс меньше общей стоимости оплаты.");
        }
    }

    public function finalizeOrder(): void
    {
        try {
            $this->processPayment($this->cart->getTotal());
        } catch (InsufficientFundsException | PaymentGatewayException $ex) {
            echo $ex->getMessage();
        } catch (CartLimitExceededException | OutOfStockException $ex) {
            echo $ex->getMessage();
        }
    }
}
