<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Src\Task1;

class MostRecentTest extends TestCase
{
    public function testMostRecentValues(): void
    {
        $this->assertSame(Task1::mostRecent('word apple word hamster'), 'word');
        $this->assertSame(Task1::mostRecent('apple word word word hamster'), 'word');
        $this->assertSame(Task1::mostRecent('1 2 3                     1 2 3'), '1');
        $this->assertSame(Task1::mostRecent('1'), '1');
        $this->assertSame(Task1::mostRecent(''), '');
    }

    public function testMostRecentValueException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Task1::mostRecent(str_repeat('a', 1001));
    }
}
