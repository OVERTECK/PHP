<?php

declare(strict_types=1);

namespace Checkout;

use Cart\Cart;
use myExceptions\IncorrectPaymentMethod;
use myExceptions\InsufficientFundsException;
use myExceptions\PaymentGatewayException;

class Checkout
{
    private Cart $cart;
    private string $paymentMethod = 'credit card';
    private float $userBalance;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function setPaymentMethod($method): void
    {
        $this->paymentMethod = $method;
    }

    public function processPayment($amount): void
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
        } catch (InsufficientFundsException $ex) {
            echo $ex->getMessage();
        } catch (PaymentGatewayException $ex) {
            echo $ex->getMessage();
        }
    }
}
