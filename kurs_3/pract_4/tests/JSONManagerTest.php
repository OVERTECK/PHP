<?php

namespace Tests;

use App\JSONManager;
use App\MyException\InvalidPathToFileException;

class JSONManagerTest extends \PHPUnit\Framework\TestCase
{
    private string $path = 'files/file.json';

    function testReadWriteFile()
    {
        $obj = new JSONManager();

        $obj->writeFile($this->path, '{"a":1,"b":2,"c":3,"d":4,"e":5}');

        $result = $obj->readFile($this->path);

        self::assertSame('{"a":1,"b":2,"c":3,"d":4,"e":5}', $result);
    }

    function testReadFileException()
    {
        $obj = new JSONManager();

        self::expectException(InvalidPathToFileException::class);

        $obj->readFile('12345');
    }

    function testWriteFileException()
    {
        $obj = new JSONManager();

        self::expectException(InvalidPathToFileException::class);

        $obj->writeFile('12345', '');
    }
}