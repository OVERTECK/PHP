<?php

declare(strict_types=1);

namespace App;

use PDO;
use App\Exceptions\UserNotFound;

class DataBase
{
    private UserDBInterface $db;
    public function __construct(UserDBInterface $db)
    {
        $this->db = $db;
    }

    /**
     * @param  \App\User $newUser
     * @return bool
     */
    public function addUser(User $newUser): bool
    {
        try {
            return $this->db->addUser($newUser);
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
     * @return array<array<string>>
     */
    public function searchUserByLogin(string $searchLogin): array
    {
        return $this->db->searchUserByLogin($searchLogin);
    }

    /**
     * @param  string $searchEmail
     * @return array<array<string>>
     */
    public function searchUserByEmail(string $searchEmail): array
    {
        return $this->db->searchUserByEmail($searchEmail);
    }

    /**
     * @param  int       $id
     * @param  \App\User $newUser
     * @return bool
     */
    public function changeUserById(int $id, User $newUser): bool
    {
        try {
            return $this->db->changeUserById($id, $newUser);
        } catch (UserNotFound $ex) {
            echo $ex->getMessage();

            return false;
        }
    }

    /**
     * @return array<array<string>>
     */
    public function getUsers(): array
    {
        return $this->db->getUsers();
    }

    public function deleteUserByLogin(string $login): bool
    {
        try {
            return $this->db->deleteUserByLogin($login);
        } catch (UserNotFound $ex) {
            echo $ex->getMessage();

            return false;
        }
    }
}
