<?php

namespace App\MessageHandler;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use App\Message\DeleteUserMessage;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

#[AsMessageHandler]
class DeleteUserHandler
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserRepository $userRepository
    ) {}


    public function __invoke(DeleteUserMessage $message)
    {
        $searchedUser = $this->userRepository->find($message->getUserId());

        if ($searchedUser !== null) {
            $this->em->remove($searchedUser);
            $this->em->flush();
        }
    }
}
