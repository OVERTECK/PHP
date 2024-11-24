<?php

declare(strict_types=1);

namespace Tests;

require_once "vendor\autoload.php";

use App\User;
use PDO;
use PHPUnit\Db;
use PHPUnit\Framework\TestCase;

class DataBaseTest extends TestCase
{
    public function testAddUser(User $user): void
    {
        $mock = self::createMock(PDO::class);
        $mock->method('prepare')->willReturn();

        new MockDa
    }


}
