<?php

namespace Tests;

use App\Exceptions\InvalidEmail;
use App\Exceptions\InvalidLogin;
use App\Exceptions\InvalidPassword;
use App\User;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class UserValidTest extends TestCase
{
    private User $obj;
    private ReflectionClass $reflectorUser;
    public function SetUp(): void
    {
        parent::setUp();

        $this->obj = new User("root", "korkin.06@inbox.ru", "12345678910");
        $this->reflectorUser = new ReflectionClass(User::class);
    }

    public static function dataProviderFailsEmail(): array
    {
        return [
            ['korkin.06@inboxru'],
            ['korkin.06inbox.ru'],
            ['6@inbox.ru'],
            ['korkin.06@i.ru'],
            ['k@inbox.ru']
        ];
    }
    #[DataProvider("dataProviderFailsEmail")]
    public function testValidEmailFails(string $email): void
    {
        self::expectException(InvalidEmail::class);

        $method = $this->reflectorUser->getMethod('validEmail');

        $method->invoke($this->obj, $email);
    }

    public static function dataProviderValidEmail(): array
    {
        return [
            ['korkin.06@inbox.ru'],
            ['zulloutraubraprei-3899@yopmail.com'],
            ['hanosox-epi36@bk.ru'],
            ['xujite_luni99@yandex.ru'],
            ['bedi-magune41@yahoo.com']
        ];
    }
    #[DataProvider('dataProviderValidEmail')]
    public function testValidEmail($email): void
    {
        $method = $this->reflectorUser->getMethod('validEmail');
        $result = $method->invoke($this->obj, $email);

        self::assertSame(true, $result);
    }


    public static function dataProviderLogin(): array
    {
        return [
            ['root'],
            ['1234567'],
            ['root12345'],
            ['12345root'],
            ['1234root1234'],
            ['root-1234+root']
        ];
    }
    #[DataProvider('dataProviderLogin')]
    public function testValidLogin($login): void
    {
        $method = $this->reflectorUser->getMethod('validLogin');
        $result = $method->invoke($this->obj, $login);

        self::assertSame(true, $result);
    }

    public static function dataProviderLoginException(): array
    {
        return [
            [''],
            ['roo'],
            ['12345671111111111111111'],
            ['123123  12312312'],
            ['12345   root'],
            ['1234ro   ot1234']
        ];
    }
    #[DataProvider('dataProviderLoginException')]
    public function testValidLoginException($login): void
    {
        self::expectException(InvalidLogin::class);

        $method = $this->reflectorUser->getMethod('validLogin');
        $result = $method->invoke($this->obj, $login);

        self::assertSame($login, $result);
    }

    public static function dataProviderPasswordException(): array
    {
        return [
            [''],
            ['roo'],
            ['123'],
            ['123456'],
            ['123456789'],
            [str_repeat('1', 101)]
        ];
    }
    #[DataProvider('dataProviderPasswordException')]
    public function testValidPasswordException($password): void
    {
        self::expectException(InvalidPassword::class);

        $method = $this->reflectorUser->getMethod('validPassword');
        $result = $method->invoke($this->obj, $password);

        self::assertSame($password, $result);
    }

    public static function dataProviderPassword(): array
    {
        return [
            ['1234567890'],
            ['qwertyuiop'],
            ['qwertyuiop1234567890'],
            [str_repeat('1', 100)]
        ];
    }
    #[DataProvider('dataProviderPassword')]
    public function testValidPassword($password): void
    {
        $method = $this->reflectorUser->getMethod('validPassword');
        $result = $method->invoke($this->obj, $password);

        self::assertSame(true, $result);
    }
}