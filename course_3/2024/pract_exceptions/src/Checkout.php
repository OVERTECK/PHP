<?php

declare(strict_types=1);

namespace App;

require_once 'vendor\\autoload.php';

use App\Cart;
use App\Exceptions\CartLimitExceededException;
use App\Exceptions\InsufficientFundsException;
use App\Exceptions\OutOfStockException;
use App\Exceptions\PaymentGatewayException;

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
     * @param float $amount
     * @throws \App\Exceptions\PaymentGatewayException
     * @throws \App\Exceptions\InsufficientFundsException
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
