<?php

declare(strict_types=1);


use PHPUnit\Framework\TestCase;
require_once 'D:\Projects\PHP\kurs_2\pract3\src\task1.php';

class MostRecentTest extends TestCase
{
    public function testMostRecentValues(): void
    {
        $this->assertSame(mostRecent('word apple word hamster'), 'word');
        $this->assertSame(mostRecent('apple word word word hamster'), 'word');
        $this->assertSame(mostRecent('1 2 3                     1 2 3'), '1');
        $this->assertSame(mostRecent('1'), '1');
        $this->assertSame(mostRecent(''), '');
    }

    public function testMostRecentValueError(): void
    {
        $this->expectException(ValueError::class);

        mostRecent(str_repeat('a', 1001));
    }

    public function testMostRecentTypes(): void
    {
        $this->expectException(TypeError::class);

        mostRecent(1);
        mostRecent(false);
        mostRecent([1, 2, 3, 4]);
    }
}
