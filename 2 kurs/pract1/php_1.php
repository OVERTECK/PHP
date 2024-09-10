<?php

function mathOperations($num1, $num2, $operation)
{
    switch ($operation) {
        case "+":
            return $num1 + $num2;
        case "-":
            return $num1 - $num2;
        case "*":
            return $num1 * $num2;
        case "/":
            if ($num2 === 0) {
                return "На ноль делить нельзя";
            }
            return $num1 / $num2;
        default:
            return "Неверная операция";
    }
}

$num1 = readline();
$num2 = readline();
$operation = readline();

echo mathOperations($num1, $num2, $operation);