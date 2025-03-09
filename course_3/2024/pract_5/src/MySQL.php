<?php

namespace App;

use App\Exceptions\UserNotFound;
use PDO;

class MySQL implements UserDBInterface
{
    private \PDO $pdo;

    public function __construct(string $dsn, string $login, string $password)
    {
        $this->pdo = new \PDO($dsn, $login, $password);
    }

    public function addUser(User $newUser): bool
    {
        $pattern = $this->pdo->prepare('INSERT INTO db_php.users(login, email, password) VALUES(:login, :email, :password)');

        $pattern->bindValue('login', $newUser->getLogin(), PDO::PARAM_STR);
        $pattern->bindValue('email', $newUser->getEmail(), PDO::PARAM_STR);
        $pattern->bindValue('password', password_hash($newUser->getLogin(), PASSWORD_DEFAULT), PDO::PARAM_STR);

        $pattern->execute();

        return true;
    }

    public function searchUserByLogin(string $searchLogin): array
    {
        $pattern = $this->pdo->prepare('SELECT * FROM users WHERE login = :login');

        $pattern->bindValue('login', $searchLogin, PDO::PARAM_STR);

        $pattern->execute();

        if ($pattern->fetch() == 0) {
            return $this->getUsers();
        }

        $pattern = $this->pdo->prepare('SELECT * FROM users WHERE login = :login');

        $pattern->bindValue('login', $searchLogin, PDO::PARAM_STR);

        $pattern->execute();

        return $pattern->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchUserByEmail(string $searchEmail): array
    {
        $pattern = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');

        $pattern->bindValue('email', $searchEmail, PDO::PARAM_STR);

        $pattern->execute();

        if ($pattern->fetch() == 0) {
            return $this->getUsers();
        }

        $pattern = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');

        $pattern->bindValue('email', $searchEmail, PDO::PARAM_STR);

        $pattern->execute();

        return $pattern->fetchAll(PDO::FETCH_ASSOC);
    }

    public function changeUserById(int $id, User $newUser): bool
    {
        $pattern = $this->pdo->prepare('SELECT * FROM users WHERE idusers = :id');

        $pattern->bindValue('id', $id, PDO::PARAM_INT);

        $pattern->execute();

        if ($pattern->fetch() == 0) {
            throw new UserNotFound("Exception. User with id = '$id' not found.");
        }

        $pattern = $this->pdo->prepare('UPDATE db_php.users SET login = :login, email = :email, password = :password WHERE idusers = :id');

        $pattern->bindValue('id', $id, PDO::PARAM_INT);
        $pattern->bindValue('login', $newUser->getLogin(), PDO::PARAM_STR);
        $pattern->bindValue('email', $newUser->getEmail(), PDO::PARAM_STR);
        $pattern->bindValue('password', password_hash($newUser->getLogin(), PASSWORD_DEFAULT), PDO::PARAM_STR);

        $pattern->execute();

        return true;
    }
    public function getUsers(): array
    {
        $response = $this->pdo->query("SELECT * FROM users");

        if (!is_bool($response)) {
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        return [];
    }

    public function deleteUserByLogin(string $login): bool
    {
        $pattern = $this->pdo->prepare('SELECT * FROM users WHERE login = :login');

        $pattern->bindValue('login', $login, PDO::PARAM_STR);

        $pattern->execute();

        if ($pattern->fetch() == 0) {
            throw new UserNotFound("Exception. User with login = '$login' not found.");
        }

        $pattern = $this->pdo->prepare('DELETE FROM db_php.users WHERE login = :login');

        $pattern->bindValue('login', $login, PDO::PARAM_STR);

        $pattern->execute();

        return true;
    }
}
