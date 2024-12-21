<?php

declare(strict_types=1);

use App\BrownCart;
use App\Cloth;

require_once __DIR__ . '/vendor/autoload.php';

$brownCart = new BrownCart(title: "Карта 1",
                        production: [Cloth::class],
                        effect:"эффект",
                        price: [],
                        numberEpoch: 1,
                        minCountPlayers: 2);

echo $brownCart->getColor();