<?php

namespace App;

interface UserDBInterface
{
    function __construct(string $dsn, string $login, string $password);

    function addUser(User $newUser): bool;

    /**
     * @param string $searchLogin
     * @return array<array<string>:>
     */
    function searchUserByLogin(string $searchLogin): array;

    /**
     * @param string $searchEmail
     * @return array<array<string>>
     */
    function searchUserByEmail(string $searchEmail): array;

    function changeUserById(int $id, User $newUser): bool;

    /**
     * @return array<array<string>>
     */
    function getUsers(): array;

    function deleteUserByLogin(string $login): bool;
}
