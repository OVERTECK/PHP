<?php

declare(strict_types=1);

namespace User\Pract3;

require_once "vendor\\autoload.php";

$notManager = new NotificationManager();

$smsNot = new SMSNotification("Отправлено", "SMS");

$emailNot = new EmailNotification("Отправлено", "Email");

$notManager->sendNotification($smsNot, "Привет");

$notManager->sendNotification($smsNot, "Some message");

$notManager->sendNotification($emailNot, "Email message");

print_r($notManager->getNotificationHistory());

$notManager->writeHistoryToFile("history.txt");
