<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateUserCommandTest extends KernelTestCase
{
    public function testExecute(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);

        $command = $application->find('app:greet-user');
        $commandTester = new CommandTester($command);

        # Базовая проверка
        $commandTester->execute([
            'username' => 'Walter',
        ]);

        $this->assertStringContainsString('Hello, Walter', $commandTester->getDisplay());

        # Проверка опции --shout
        $commandTester->execute([
            'username' => 'Walter',
            '--shout' => true,
        ]);

        $this->assertStringContainsString('HELLO, WALTER', $commandTester->getDisplay());

        # Проверка опции -s
        $commandTester->execute([
            'username' => 'Walter',
            '-s' => true,
        ]);

        $this->assertStringContainsString('HELLO, WALTER', $commandTester->getDisplay());


        # Проверка обязательности аргумента username
        $this->expectException(\RuntimeException::class);

        $commandTester->execute([]);
    }
}