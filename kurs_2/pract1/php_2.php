<?php

function colorMixing($color1, $color2)
{
    $color1 = strtolower($color1);
    $color2 = strtolower($color2);

    if (($color1 === "красный" && $color2 === "синий") || ($color1 === "синий" && $color2 === "красный")) {
        return "фиолетовый";
    } elseif (($color1 === "красный" && $color2 === "желтый") || ($color1 === "желтый" && $color2 === "красный")) {
        return "ораньжевый";
    } elseif (($color1 === "синий" && $color2 === "желтый") || ($color1 === "желтый" && $color2 === "синий")) {
        return "зеленый";
    } elseif ($color1 === $color2) {
        return $color1;
    } else {
        return "Неверный цвет";
    }
}

$color1 = readline();
$color2 = readline();

echo colorMixing($color1, $color2);