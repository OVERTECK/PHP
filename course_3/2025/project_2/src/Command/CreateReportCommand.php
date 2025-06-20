<?php

namespace App\Command;

use App\Repository\UserRepository;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Core\File;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Mime\Part\DataPart;

#[AsCommand(name: 'app:create-report')]
class CreateReportCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserRepository $userRepository,
        private TransportInterface $mailer
    ) {
        parent::__construct();
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        
        $writter = WriterEntityFactory::createXLSXWriter();

        $currentDate = str_replace(" ", "_", date("Y-m-d H:i:s"));
        
        $fileName = "report_$currentDate.xlsx";

        $filePath = "src/Report/$fileName";

        $writter->openToFile($filePath);
        
        $users = $this->userRepository->createQueryBuilder("u")
            ->select("u.first_name, u.last_name, u.status, u.email, u.telegram, u.address, d.title")
            ->leftJoin("u.department", "d")
            ->getQuery()
            ->getResult();

        $headers = ["FirstName", "LastName", "Status", "Email", "Telegram", "Address", "Title"];

        $headers = WriterEntityFactory::createRowFromArray($headers);

        $writter->addRow($headers);

        foreach ($users as $user) {

            $row = WriterEntityFactory::createRowFromArray($user);

            $writter->addRow($row);
        }

        $writter->close();

        // $email = (new Email())
        //     ->from('sasakorkin321@gmail.com')
        //     ->to("korkin.06@inbox.ru")
        //     ->addPart(new DataPart(fopen($filePath, "r"), $fileName))
        //     ->subject('Ваш отчёт готов')
        //     ->html('<p>Отчёт во вложении.</p>')
        //     ->text('Отчёт во вложении.');

        // $this->mailer->send($email);

        return Command::SUCCESS;
    }
}
