<?php

function intersection($a1, $b1, $a2, $b2)
{
    if (min($b1, $b2) < max($a1, $a2)) {
        return "Пустое множество";
    } elseif (min($b1, $b2) === max($a1, $a2)) {
        return min($b1, $b2);
    } else {
        return "[" . max($a1, $a2) . ":" . min($b1, $b2) . "]";
    }
}

$a1 = readline();
$b1 = readline();
$a2 = readline();
$b2 = readline();

echo intersection($a1, $b1, $a2, $b2);