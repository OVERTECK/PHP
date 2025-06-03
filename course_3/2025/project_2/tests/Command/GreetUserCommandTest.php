<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateUserCommandTest extends KernelTestCase
{
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);

        $command = $application->find('app:greet-user');
        $this->commandTester = new CommandTester($command);
    }
    
    # Базовая проверка
    public function testExecute(): void
    {
        $this->commandTester->execute([
            'username' => 'Walter',
        ]);

        $this->assertStringContainsString('Hello, Walter', $this->commandTester->getDisplay());
    }

    # Проверка опции --shout
    public function testOption(): void
    {
        $this->commandTester->execute([
            'username' => 'Walter',
            '--shout' => true,
        ]);

        $this->assertStringContainsString('HELLO, WALTER', $this->commandTester->getDisplay());
    }

    # Проверка опции -s
    public function testOption2(): void
    {
        $this->commandTester->execute([
            'username' => 'Walter',
            '-s' => true,
        ]);

        $this->assertStringContainsString('HELLO, WALTER', $this->commandTester->getDisplay());
    }

    # Проверка обязательности аргумента username
    public function testArgument(): void
    {
        $this->expectException(\RuntimeException::class);

        $this->commandTester->execute([]);
    }
}
