<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Src\Task2;

class ArrayUniqueTest extends TestCase
{
    public function testArrayUnique(): void
    {
        $this->assertSame(Task2::arrayUnique([1, 2, 2]), [1, 2]);
        $this->assertSame(Task2::arrayUnique([1, 1, 2]), [1, 2]);
        $this->assertSame(Task2::arrayUnique([1, 2, 3]), [1, 2, 3]);
        $this->assertSame(Task2::arrayUnique([1, 2, 2, 3]), [1, 2, 3]);
        $this->assertSame(Task2::arrayUnique([]), []);
    }
}
