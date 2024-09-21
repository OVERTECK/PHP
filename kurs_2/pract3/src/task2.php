<?php

function arrayUnique(array $arr) {
    $resultArr = [];

    foreach ($arr as $value) {
        if (!in_array($value, $resultArr)) array_push($resultArr, $value);
    }

    return $resultArr;
} 
 
print_r(arrayUnique([1, 2, 2, 3, 1, 3, 3, 4])); 