<?php

namespace App;

class FileJSON implements FileManager
{
    public function readFile($fileName): bool|string
    {
        return file_get_contents($fileName);
    }
    public function writeFile($fileName, $data): void
    {
        $file = json_decode(file_get_contents($fileName), associative: True);

        
    }
}
