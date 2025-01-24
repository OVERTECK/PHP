<?php

declare(strict_types=1);

namespace Tests;

use App\Exceptions\InvalidEmail;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use App\User;
use ReflectionClass;

class UserTest extends TestCase
{
    public static function dataProviderPassword(): array
    {
        return [
            ["12345678910"],
            ["asdfdgfdghh"],
            ["modf1240fksdo"]

        ];
    }
    #[DataProvider("dataProviderPassword")]
    public function testGetPassword(string $password): void
    {
        $returnedUser = new User('root', 'korkin.06@inbox.ru', $password);

        self::assertSame($password, $returnedUser->getPassword());
    }

    public static function dataProviderLogin(): array
    {
        return [
            ["root"],
            ["123456"],
            ["qwerty"],
            ["1234qwerty567"]
        ];
    }
    #[DataProvider("dataProviderLogin")]
    public function testGetLogin(string $login): void
    {
        $returnedUser = new User($login, 'korkin.06@inbox.ru', '12345678910');

        self::assertSame($login, $returnedUser->getLogin());
    }

    public static function dataProviderEmail(): array
    {
        return [
            ['korkin.06@inbox.ru'],
            ['zulloutraubraprei-3899@yopmail.com'],
            ['hanosox-epi36@bk.ru'],
            ['xujite_luni99@yandex.ru'],
            ['bedi-magune41@yahoo.com']
        ];
    }

    #[DataProvider("dataProviderEmail")]
    public function testGetEmail(string $email): void
    {
        $returnedUser = new User('root', $email, '12345678910');

        self::assertSame($email, $returnedUser->getEmail());
    }
}
