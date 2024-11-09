<?php

declare(strict_types=1);

namespace App;

use App\MyException as myEx;

require_once 'vendor\autoload.php';

class TXTManager implements FileManager
{
    public function readFile(string $pathToFile): ?string
    {
        try {
            if (!file_exists($pathToFile)) {
                throw new myEx\InvalidPathToFileException("Invalid path to file.");
            }

            $content = file_get_contents($pathToFile);

            if ($content !== false) {
                return $content;
            }

            return null;

        } catch (myEx\InvalidPathToFileException $ex) {
            echo $ex->getMessage();

            return null;
        }
    }
    public function writeFile(string $pathToFile, string $data): void
    {
        try {
            if (!file_exists($pathToFile)) {
                throw new myEx\InvalidPathToFileException("Invalid path to file.");
            }
            file_get_contents($pathToFile);

            file_put_contents($pathToFile, $data);
        } catch (myEx\InvalidPathToFileException $ex) {
            echo $ex->getMessage();
        }
    }
}
