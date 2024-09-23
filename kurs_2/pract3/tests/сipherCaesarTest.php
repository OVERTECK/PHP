<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Src\Task3;

class сipherCaesarTest extends TestCase
{
    public function testCipherCaesarValues(): void
    {
        $this->assertSame(Task3::сipherCaesar('а', 1), 'б');
        $this->assertSame(Task3::сipherCaesar('а', 32), 'я');
        $this->assertSame(Task3::сipherCaesar('абв', 3), 'где');
        $this->assertSame(Task3::сipherCaesar('я', 2), 'б');
        $this->assertSame(Task3::сipherCaesar('эюя', 3), 'абв');
    }

    public function testCipherCaesarInvalidValueException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Task3::сipherCaesar('а', 60);
    }
}
