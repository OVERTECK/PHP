<?php

namespace App;

interface FileManager
{
    /**
     * Summary of readFile
     *
     * @param  string $pathToFile
     * @return ?string
     */
    public function readFile(string $pathToFile);

    /**
     * Summary of writeFile
     *
     * @param  string $pathToFile
     * @param  string $data
     * @return void
     */
    public function writeFile(string $pathToFile, string $data);
}
