<?php

namespace myExceptions;

class OutOfStockException extends \Exception {}

class CartLimitExceededException extends \Exception {}

class InsufficientFundsException extends \Exception {}

class PaymentGatewayException extends \Exception {}
