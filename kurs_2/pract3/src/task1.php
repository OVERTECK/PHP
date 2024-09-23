<?php

namespace Src;

use InvalidArgumentException;

class Task1
{
    /**
     * Summary of mostRecent
     * @param string $text
     * @throws InvalidArgumentException
     * @return string
     */
    public static function mostRecent(string $text): string
    {
        if (strlen($text) > 1000) throw new InvalidArgumentException("Текст больше тысячи символов");

        if ($text === '') return '';

        #Делим строку по пробелам
        $textSplit = explode(' ', $text);

        #Удаляем пробелы из массива
        $textSplit = array_diff($textSplit, [""]);

        #Формируем массив с количеством слов
        $textSplit = array_count_values(array: $textSplit);

        #Максимальное количество слов
        $maxCount = max($textSplit);

        #Ловим первое попавшееся слово с максимальным количеством
        foreach ($textSplit as $key => $value) {
            if ($value === $maxCount) {
                $resultWord = $key;
                break;
            }
        }

        return $resultWord;
    }
}
