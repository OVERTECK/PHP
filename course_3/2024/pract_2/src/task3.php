<?php

namespace Src;

use InvalidArgumentException;

class Task3
{
    /**
     * Summary of сipherCaesar
     * @param string $text
     * @param int $key
     * @throws \InvalidArgumentException
     * @return string
     */
    public static function сipherCaesar(string $text, int $key): string
    {

        if ($key > 33) throw new InvalidArgumentException('Параметр $key не должен быть больше 33.');

        if ($text === '') return '';

        $arrLettes = [
            "а",
            "б",
            "в",
            "г",
            "д",
            "е",
            "ё",
            "ж",
            "з",
            "и",
            "й",
            "к",
            "л",
            "м",
            "н",
            "о",
            "п",
            "р",
            "с",
            "т",
            "у",
            "ф",
            "х",
            "ц",
            "ч",
            "ш",
            "щ",
            "ъ",
            "ы",
            "ь",
            "э",
            "ю",
            "я"
        ];

        $resultWord = "";

        $arrText = str_split($text, 2);

        foreach ($arrText as $letter) {
            $indexLetterInArrLetters = array_search($letter, $arrLettes);

            if ($indexLetterInArrLetters + $key > 32) {
                $resultWord .= $arrLettes[$indexLetterInArrLetters + $key - 33];
                continue;
            }

            $resultWord .= $arrLettes[$indexLetterInArrLetters + $key];
        }

        return $resultWord;
    }
}
