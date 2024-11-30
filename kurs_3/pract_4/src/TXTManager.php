<?php

declare(strict_types=1);

namespace App;

use App\MyException as myEx;

class TXTManager implements FileManager
{
    public function readFile(string $pathToFile): ?string
    {
        if (!file_exists($pathToFile)) {
            throw new myEx\InvalidPathToFileException("Invalid path to file.");
        }

        return file_get_contents($pathToFile);
    }
    public function writeFile(string $pathToFile, string $data): void
    {
        if (!file_exists($pathToFile)) {
            throw new myEx\InvalidPathToFileException("Invalid path to file.");
        }

        file_put_contents($pathToFile, $data);
    }
}
