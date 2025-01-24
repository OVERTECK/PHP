<?php

namespace App;

interface FileManager
{
    public function readFile(string $pathToFile);

    public function writeFile(string $pathToFile, string $data): void;
}
