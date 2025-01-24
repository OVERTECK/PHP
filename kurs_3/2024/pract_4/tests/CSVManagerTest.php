<?php

namespace Tests;

use App\CSVManager;
use App\MyException\InvalidPathToFileException;
use App\MyException\InvalidSplitterException;
use PHPUnit\Framework\Attributes\DataProvider;

class CSVManagerTest extends \PHPUnit\Framework\TestCase
{
    public function testGetSplitterWrite(): void
    {
        $myCSVManager = new CSVManager();

        $result = $myCSVManager->getSplitterWrite();

        self::assertSame(',', $result);
    }

    public static function dPSetSplitterWrite(): array
    {
        return [
            ['.'],
            [','],
            ['!'],
            ['+']
        ];
    }

    #[DataProvider("dPSetSplitterWrite")]
    public function testSetSplitterWrite(string $splitter): void
    {
        $myCSVManager = new CSVManager();

        $myCSVManager->setSplitterWrite($splitter);

        $result = $myCSVManager->getSplitterWrite();

        self::assertSame($splitter, $result);
    }

    public function testSetSplitterWriteException(): void
    {
        $myCSVManager = new CSVManager();

        self::expectException(InvalidSplitterException::class);

        $myCSVManager->setSplitterWrite('');
    }

    public function testSetSplitterRead(): void
    {
        $myCSVManager = new CSVManager();

        $myCSVManager->setSplitterRead('+');

        $result = $myCSVManager->getSplitterRead();

        self::assertSame('+', $result);
    }

    public function testSetSplitterReadException(): void
    {
        $myCSVManager = new CSVManager();

        self::expectException(InvalidSplitterException::class);

        $myCSVManager->setSplitterRead('');
    }

    public static function dPReadFile(): array
    {
        return [
            ['', ['']],
            ['12345', ["12345"]],
            ['qwer,tyu', ['qwer', 'tyu']],
            ['qwe123ert', ['qwe123ert']]
        ];
    }

    #[DataProvider("dPReadFile")]
    public function testReadFile(string $data, array $expected): void
    {
        $myCSVManager = new CSVManager();

        $myCSVManager->writeFile("files/file.txt", $data);

        $result = $myCSVManager->readFile("files/file.txt");

        self::assertSame($expected, $result);
    }

    public function testReadFileException(): void
    {
        $myCSVManager = new CSVManager();

        self::expectException(InvalidPathToFileException::class);

        $myCSVManager->readFile("123456");
    }

    public function testWriteFileException(): void
    {
        $myCSVManager = new CSVManager();

        self::expectException(InvalidPathToFileException::class);

        $myCSVManager->writeFile("123456", '');
    }
}