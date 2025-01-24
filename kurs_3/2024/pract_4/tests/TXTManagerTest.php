<?php

namespace Tests;

use App\MyException\InvalidPathToFileException;
use App\TXTManager;

class TXTManagerTest extends \PHPUnit\Framework\TestCase
{
    private string $path = 'files/file.txt';

    function testReadWriteFile()
    {
        $obj = new TXTManager();

        $obj->writeFile($this->path, 'hello');

        $result = $obj->readFile($this->path);

        self::assertSame('hello', $result);
    }

    function testReadFileException()
    {
        $obj = new TXTManager();

        self::expectException(InvalidPathToFileException::class);

        $obj->readFile('12345');
    }

    function testWriteFileException()
    {
        $obj = new TXTManager();

        self::expectException(InvalidPathToFileException::class);

        $obj->writeFile('12345', '');
    }
}