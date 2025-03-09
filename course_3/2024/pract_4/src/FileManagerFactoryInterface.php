<?php

namespace App;

interface FileManagerFactoryInterface
{
    public function createCSVManager(): CSVManager;

    public function createTXTManager(): TXTManager;

    public function createJSONManager(): JSONManager;
}
