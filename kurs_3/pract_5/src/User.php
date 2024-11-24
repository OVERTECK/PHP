<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\InvalidEmail;
use App\Exceptions\InvalidLogin;
use App\Exceptions\InvalidPassword;

class User
{
    private string $login;
    private string $email;
    private string $password;
    private function validEmail(string $email): bool
    {
        $pattern = "/^[\w.%+-]{2,50}@[\w.+-]{2,30}\.\w{1,10}$/";

        $result = preg_match($pattern, $email);

        if ($result != 1) {
            throw new InvalidEmail();
        }

        return true;
    }

    private function validLogin(string $login): bool
    {
        if (4 > strlen($login) || strlen($login) > 15)
            throw new InvalidLogin('Exception. Length should be between 5 and 15 chars.');

        if (str_contains($login, ' ') !== false)
            throw new InvalidLogin('Exception. Login can`t contain spaces.');

        return true;
    }

    private function validPassword(string $password): bool
    {
        if (10 > strlen($password) || strlen($password) > 100)
            throw new InvalidPassword('Exception. Length should be between 10 and 100 chars.');

        return true;
    }

    public function __construct(string $login, string $email, string $password) 
    {
        $this->validEmail($email);
        $this->validLogin($login);
        $this->validPassword($password);

        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
