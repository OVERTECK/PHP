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
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsCommand(name: 'app:greet-user')]
class GreetUserCommand extends Command
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
        $userName = $input->getArgument("username");
        $shout = $input->getOption("shout");

        if ($shout) {
            $output->writeln("HELLO, " . strtoupper($userName));
        } 
        else {
            $output->writeln("Hello, {$userName}");
        }

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this
            ->addArgument("username", InputArgument::REQUIRED)
            ->addOption("shout", "s", InputOption::VALUE_NONE);
    }
}