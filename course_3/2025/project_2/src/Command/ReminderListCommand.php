<?php

namespace App\Command;

use App\Entity\Reminder;
use App\Entity\User;
use App\Repository\DepartmentRepository;
use App\Repository\ReminderRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use PHPUnit\Util\Xml\Validator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsCommand(name: 'app:reminder list')]
class ReminderListCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private ReminderRepository $reminderRepository
    )
    {
        parent::__construct();
    }

    protected function execute(
        InputInterface $input, 
        OutputInterface $output): int
    {
        $userName = $input->getArgument("username");
        
        $searchedReminders = $this->reminderRepository->findBy([
            'user' => $userName,
            'isDone' => "1"
        ]);

        $output->writeln("Reminders: " . "[" . join(", ", $searchedReminders) . "]");

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this->addArgument("username", InputArgument::REQUIRED);
    }
}