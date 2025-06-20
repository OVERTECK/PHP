<?php

namespace App\Message;

class DeleteUserMessage
{
    public function __construct(
        private int $userID,
    ) {}

    public function getUserId(): int
    {
        return $this->userID;
    }
}
