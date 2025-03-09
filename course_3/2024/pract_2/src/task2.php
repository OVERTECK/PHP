<?php

namespace Src;

class Task2
{
    /**
     * Summary of arrayUnique
     * @param array $arr
     * @return array[]
     */
    public static function arrayUnique(array $arr): array
    {
        $resultArr = [];

        foreach ($arr as $value) {
            if (!in_array($value, $resultArr)) array_push($resultArr, $value);
        }

        return $resultArr;
    }
}
