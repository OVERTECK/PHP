<?php

function mostRecent(string $text) {
    if (strlen($text) > 1000) throw new ValueError("Текст больше тысячи символов");

    $text = explode(" ", $text);

    $resultWord = "";

    foreach (array_count_values($text) as $key => $value) {
        if ($value == max(array_count_values($text))) {
            $resultWord = $key;
            break;
        } 
    }

    return $resultWord;
}
 
print_r(mostRecent("3 1 1 1 1 2 2 2 2"));