<?php

declare(strict_types=1);

namespace Tests;

use PHPStan\BetterReflection\Reflection\ReflectionClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use App\User;
//use App\Exceptions as Ex;

class UserTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [""],
            ["123456"],
            ["qwerty"],
            ["1234qwerty567"]
        ];
    }

    #[DataProvider("dataProvider")]
    public function testGetPassword(string $password): void
    {
        $returnedUser = new User('root', 'korkin.06@inbox.ru', $password);

        self::assertSame($password, $returnedUser->getPassword());
    }

    #[DataProvider("dataProvider")]
    public function testGetLogin(string $login): void
    {
        $returnedUser = new User('root', $login, '123456');

        self::assertSame($login, $returnedUser->getEmail());
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
        $returnedUser = new User('root', $email, '123456');

        self::assertSame($email, $returnedUser->getEmail());
    }

    #[DataProvider('dataProviderEmail')]
    public function testValidEmail($email): void
    {

    }
}
