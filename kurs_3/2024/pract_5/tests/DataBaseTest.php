<?php

declare(strict_types=1);

namespace Tests;

use App\User;
use PDO;
use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\DataSet\MockDataSet;

class DataBaseTest extends TestCase
{
    public function testAddUser(User $user): void
    {
        $mock = self::createMock(PDO::class);
        $mock->method('prepare')->willReturn();

        $data = [
            'users' => [
                ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
                ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
            ]
        ];
        $mockDataSet = new MockDataSet($data);
    }


}
