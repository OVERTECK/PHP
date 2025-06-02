<?php

namespace App\Command;

use App\Entity\Reminder;
use App\Repository\ReminderRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:reminder add')]
class ReminderAddCommand extends Command
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
        $message = $input->getArgument("message");

        $reminder = new Reminder();
        $reminder->setUser($userName);
        $reminder->setCreatedAt(new \DateTime());
        $reminder->setMessage($message);
        
        $this->em->persist($reminder);
        $this->em->flush();

        $output->writeln("Reminder added successfully.");

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this
            ->addArgument("username", InputArgument::REQUIRED)
            ->addArgument("message", InputArgument::REQUIRED);
    }
}