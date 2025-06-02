<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\DepartmentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use PHPUnit\Util\Xml\Validator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsCommand(name: 'app:create-user')]
class CreateUserCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private DepartmentRepository $departmentRepository,
        private ValidatorInterface $validatorInterface
    )
    {
        parent::__construct();
    }

    protected function execute(
        InputInterface $input, 
        OutputInterface $output): int
    {
        $newUser = new User();

        $errors = $this->validatorInterface->validate($newUser);

        do {
            $userFirstName = readline("\n\033[92m" . " Enter the user's firstname:" . "\033[39m" . "\n> ");
            $newUser->setFirstName($userFirstName);

            $errors = $this->validatorInterface->validate($newUser, null, ["firstName"]);

            if ($errors->count() > 0) {
                foreach ($errors as $error) {
                    $output->writeln("\033[91m" . $error->getMessage() . "\033[49m");
                }
            }
        } while ($errors->count() > 0);

        do {
            $userLastName = readline("\n\033[92m" . " Enter the user's lastname:" . "\033[39m" . "\n> ");
            $newUser->setLastName($userLastName);

            $errors = $this->validatorInterface->validate($newUser, null, ["lastName"]);

            if ($errors->count() > 0) {
                foreach ($errors as $error) {
                    $output->writeln("\033[91m" . $error->getMessage() . "\033[49m");
                }
            }
        } while ($errors->count() > 0);

        do {
            $userAge = (int)readline("\n\033[92m" . " Enter the user's age:" . "\033[39m" . "\n> ");
            $newUser->setAge($userAge);

            $errors = $this->validatorInterface->validate($newUser, null, ["age"]);

            if ($errors->count() > 0) {
                foreach ($errors as $error) {
                    $output->writeln("\033[91m" . $error->getMessage() . "\033[49m");
                }
            }
        } while ($errors->count() > 0);

        do {
            $userStatus = readline("\n\033[92m" . " Enter the user's status:" . "\033[39m" . "\n> ");
            $newUser->setStatus($userStatus);

            $errors = $this->validatorInterface->validate($newUser, null, ["status"]);

            if ($errors->count() > 0) {
                foreach ($errors as $error) {
                    $output->writeln("\033[91m" . $error->getMessage() . "\033[49m");
                }
            }
        } while ($errors->count() > 0);

        do {
            $userEmail = readline("\n\033[92m" . " Enter the user's email:" . "\033[39m" . "\n> ");
            $newUser->setEmail($userEmail);

            $errors = $this->validatorInterface->validate($newUser, null, ["email"]);

            if ($errors->count() > 0) {
                foreach ($errors as $error) {
                    $output->writeln("\033[91m" . $error->getMessage() . "\033[49m");
                }
            }
        } while ($errors->count() > 0);
        
        do {
            $userTelegram = readline("\n\033[92m" . " Enter the user's telegram:" . "\033[39m" . "\n> ");
            $newUser->setTelegram($userTelegram);

            $errors = $this->validatorInterface->validate($newUser, null, ["telegram"]);

            if ($errors->count() > 0) {
                foreach ($errors as $error) {
                    $output->writeln("\033[91m" . $error->getMessage() . "\033[49m");
                }
            }
        } while ($errors->count() > 0);

        do {
            $userAddress = readline("\n\033[92m" . " Enter the user's address:" . "\033[39m" . "\n> ");
            $newUser->setAddress($userAddress);

            $errors = $this->validatorInterface->validate($newUser, null, ["address"]);

            if ($errors->count() > 0) {
                foreach ($errors as $error) {
                    $output->writeln("\033[91m" . $error->getMessage() . "\033[49m");
                }
            }
        } while ($errors->count() > 0);
        
        do {
            $userDepartmentId = readline("\n\033[92m" . " Enter the user's department:" . "\033[39m" . "\n> ");
            $userDepartment = $this->departmentRepository->find($userDepartmentId);
            $newUser->setDepartment($userDepartment);

            $errors = $this->validatorInterface->validate($newUser, null, ["department"]);

            if ($errors->count() > 0) {
                foreach ($errors as $error) {
                    $output->writeln("\033[91m" . $error->getMessage() . "\033[49m");
                }
            }
        } while ($errors->count() > 0);
        
        $userTitleImage = readline("\n\033[92m" . " Enter the user's title image:" . "\033[39m" . "\n> ");
        $newUser->setPathToImage($userTitleImage);

        $this->em->persist($newUser);
        $this->em->flush();

        $output->writeln("\n\033[92m" . "Пользователь успешно добавлен." . "\033[39m");

        return Command::SUCCESS;
    }
}