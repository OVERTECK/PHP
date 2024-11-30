<?php

declare(strict_types=1);

namespace App;

use App\MyException as myEx;

class CSVManager implements FileManager
{
    private string $splitterRead = ',';

    public function getSplitterRead(): string
    {
        return $this->splitterRead;
    }

    public function setSplitterRead(string $newSplitter): void
    {
        if ($newSplitter === '') {
            throw new myEx\InvalidSplitterException();
        }

        $this->splitterRead = $newSplitter;
    }

    private string $splitterWrite = ',';

    public function getSplitterWrite(): string
    {
        return $this->splitterWrite;
    }

    public function setSplitterWrite(string $newSplitter): void
    {
        if ($newSplitter === '') {
            throw new myEx\InvalidSplitterException();
        }

        $this->splitterWrite = $newSplitter;
    }

    public function readFile(string $pathToFile): ?array
    {
        if (!file_exists($pathToFile)) {
            throw new myEx\InvalidPathToFileException("Invalid path to file.");
        }

        return explode($this->getSplitterRead(), file_get_contents($pathToFile));
    }
    public function writeFile(string $pathToFile, string $data): void
    {
        if (!file_exists($pathToFile)) {
            throw new myEx\InvalidPathToFileException("Invalid path to file.");
        }

        $arr = explode($this->getSplitterRead(), $data);

        file_put_contents($pathToFile, implode($this->getSplitterWrite(), $arr));
    }
}
