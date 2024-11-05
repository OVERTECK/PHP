<?php

namespace App;

declare(strict_types=1);

interface FileManager
{
    public function readFile($fileName);
    public function writeFile($fileName, $data);
}
