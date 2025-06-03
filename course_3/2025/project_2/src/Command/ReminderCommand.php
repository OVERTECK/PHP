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

#[AsCommand(name: 'app:reminder')]
class ReminderCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private ReminderRepository $reminderRepository
    ) {
        parent::__construct();
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $action = $input->getArgument("action");

        switch ($action) {
            case 'add':
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

            case 'list':
                $userName = $input->getArgument("username");
                $since = $input->getOption("since");

                if ($since) {

                    $startDate = new DateTime("-{$since} days");

                    $query = $this->reminderRepository->createQueryBuilder("r")
                        ->where("r.createdAt >= :date")
                        ->andWhere("r.user = :userName")
                        ->andWhere("r.isDone = 1")
                        ->setParameter('date', $startDate)
                        ->setParameter("userName", $userName)
                        ->getQuery();

                    $searchedReminders = $query->getResult();
                } else {

                    $searchedReminders = $this->reminderRepository->findBy([
                        'user' => $userName,
                        'isDone' => "1"
                    ]);
                }

                $output->writeln("Reminders: " . "[" . join(", ", $searchedReminders) . "]");

                return Command::SUCCESS;

            case 'done':
                $idReminder = $input->getArgument("username");

                $searchedReminder = $this->reminderRepository->find($idReminder);

                $searchedReminder->setIsDone(true);

                $this->em->flush();

                $output->writeln("Reminder with id {$idReminder} changed to true.");

                return Command::SUCCESS;

            default:

                return Command::INVALID;
        }
    }

    protected function configure(): void
    {
        $this
            ->addArgument("action", InputArgument::REQUIRED)
            ->addArgument("username", InputArgument::OPTIONAL)
            ->addArgument("message", InputArgument::OPTIONAL)
            ->addOption("since", null, InputOption::VALUE_REQUIRED);
    }
}
