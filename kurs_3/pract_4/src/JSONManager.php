<?php

declare(strict_types=1);

namespace App;

use App\MyException as myEx;

class JSONManager implements FileManager
{
    public function readFile(string $pathToFile)
    {
        if (!file_exists($pathToFile)) {
            throw new myEx\InvalidPathToFileException("Invalid path to file.");
        }

        $content = file_get_contents($pathToFile);

        return json_decode($content, flags: JSON_THROW_ON_ERROR);
    }
    public function writeFile(string $pathToFile, string $data): void
    {
        if (!file_exists($pathToFile)) {
            throw new myEx\InvalidPathToFileException("Invalid path to file.");
        }

        $newData = json_encode($data, flags: JSON_THROW_ON_ERROR);

        file_put_contents($pathToFile, $newData);
    }
}
