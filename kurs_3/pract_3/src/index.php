<?php

declare(strict_types=1);

namespace User\Pract3;

require_once "vendor\\autoload.php";


$notManager = new NotificationManager();

$smsNot = new SMSNotification("Отправлено", "Обычное");

$notManager->sendNotification($smsNot, "Привет");

print_r($notManager->getNotificationHistory());

$notManager->writeHistoryToFile("history.txt");
