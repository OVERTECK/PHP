<?php

namespace Tests;

use App\CSVManager;
use App\FileManagerFabric;
use App\JSONManager;
use App\TXTManager;

class FileManagerFabricTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateCSVManager()
    {
        $myFabric = new FileManagerFabric();

        $result = $myFabric->createCSVManager();

        self::assertEquals(new CSVManager(), $result);
    }

    public function testCreateJSONManager()
    {
        $myFabric = new FileManagerFabric();

        $result = $myFabric->createJSONManager();

        self::assertEquals(new JSONManager(), $result);
    }

    public function testCreateTXTManager()
    {
        $myFabric = new FileManagerFabric();

        $result = $myFabric->createTXTManager();

        self::assertEquals(new TXTManager(), $result);
    }
}