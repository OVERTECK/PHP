<?php

declare(strict_types=1);

namespace App;

use PDO;
use App\Exceptions\UserNotFound;

class DataBase
{
    private string $host = '127.0.0.1';
    private string $db = 'db_php';
    private string $user = 'root';
    private string $password = 'root';
    private string $charset = 'utf8';
    private string $dsn;
    private PDO $pdo;
    public function __construct()
    {
        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";

        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->password);
        } catch (\PDOException $ex) {
            echo $ex;
        }
    }

    /**
     * @param  \App\User $newUser
     * @return bool
     */
    public function addUser(User $newUser): bool
    {
        try {
            $pattern = $this->pdo->prepare('INSERT INTO db_php.users(login, email, password) VALUES(:login, :email, :password)');

            $pattern->bindValue('login', $newUser->getLogin(), PDO::PARAM_STR);
            $pattern->bindValue('email', $newUser->getEmail(), PDO::PARAM_STR);
            $pattern->bindValue('password', password_hash($newUser->getLogin(), PASSWORD_DEFAULT), PDO::PARAM_STR);

            $pattern->execute();

            return true;

        } catch (\PDOException $ex) {
            $code = $ex->getCode();

            if ($code == 23000) {
                echo "Exception. One of the fields is occupied.";
            }

            return false;
        }
    }

    /**
     * @param  string $searchLogin
     * @return array<User>
     */
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

    /**
     * @param  string $searchEmail
     * @return array<User>
     */
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

    /**
     * @param  int       $id
     * @param  \App\User $newUser
     * @return bool
     */
    public function changeUserById(int $id, User $newUser): bool
    {
        try {
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

        } catch (UserNotFound $ex) {
            echo $ex->getMessage();

            return false;
        }
    }

    /**
     * @return array<User>
     */
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
        try {
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

        } catch (UserNotFound $ex) {
            echo $ex->getMessage();

            return false;
        }
    }
}
