<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\InvalidEmail;

class User
{
    private string $login;
    private string $email;
    private string $password;
    private function validEmail(string $email): void
    {
        try {
            $pattern = "/^[\w.%+-]{2,50}@[\w.+-]{3,30}\.\w{1,10}$/";

            $result = preg_match($pattern, $email);

            if ($result != 1) {
                throw new InvalidEmail();
            }

        } catch (InvalidEmail $ex) {
            echo $ex;
        }
    }
    public function __construct(string $login, string $email, string $password) 
    {
        $this->validEmail($email);

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
