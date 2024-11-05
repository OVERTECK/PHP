<?php

namespace App;

class FileTXT implements FileManager
{
    public function readFile($fileName): bool|string
    {
        $file = fopen($fileName, mode: 'r');

        return fread($file, filesize($file));
    }
    public function writeFile($fileName, $data): void
    {
        $file = fopen($fileName, mode: 'w');

        fwrite($file, $data);
    }
}
