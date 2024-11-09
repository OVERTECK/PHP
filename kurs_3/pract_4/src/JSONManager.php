<?php

declare(strict_types=1);

namespace App;

use JsonException;
use App\MyException as myEx;

class JSONManager implements FileManager
{
    public function readFile(string $pathToFile): ?string
    {
        try {
            if (!file_exists($pathToFile))
                throw new myEx\InvalidPathToFileException("Invalid path to file.");

            $content = file_get_contents($pathToFile);

            if ($content !== false) {
                $content = json_decode($content, flags: JSON_THROW_ON_ERROR);

                return $content;
            }

            return null;
        } catch (JsonException | myEx\InvalidPathToFileException $ex) {
            echo $ex->getMessage();

            return null;
        }
    }
    public function writeFile(string $pathToFile, string $data): void
    {
        try {
            if (!file_exists($pathToFile))
                throw new myEx\InvalidPathToFileException("Invalid path to file.");

            $file = json_encode($data, flags: JSON_THROW_ON_ERROR);

            file_put_contents($pathToFile, $file);
        } catch (JsonException | myEx\InvalidPathToFileException $ex) {
            echo $ex->getMessage();
        }
    }
}
