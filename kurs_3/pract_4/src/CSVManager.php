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

    public function setSplitterRead(string $newSpliter): void
    {
        $this->splitterRead = $newSpliter;
    }

    private string $splitterWrite = ',';

    public function getSplitterWrite(): string
    {
        return $this->splitterWrite;
    }

    public function setSplitterWrite(string $newSpliter): void
    {
        $this->splitterWrite = $newSpliter;
    }

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

            if ($this->getSplitterRead() !== "") {
                $arr = explode($this->getSplitterRead(), $data);
        
                file_put_contents($pathToFile, implode($this->getSplitterWrite(), $arr));
            }
        } catch (myEx\InvalidPathToFileException $ex) {
            echo $ex->getMessage();
        }
    }
}
