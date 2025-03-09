<?php

namespace App;

class FileManagerFabric implements FileManagerFactoryInterface
{
    public function createCSVManager(): CSVManager
    {
        return new CSVManager();
    }
    public function createJSONManager(): JSONManager
    {
        return new JSONManager();
    }
    public function createTXTManager(): TXTManager
    {
        return new TXTManager();
    }
}
