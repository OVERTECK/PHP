<?php

declare(strict_types=1);

namespace User\Pract3;

use Exception;

require_once "vendor\\autoload.php";

class NotificationManager
{
    private array $notificationHistory;

    public function sendNotification(Notification $notification, string $messageText): void
    {
        $notification->send($messageText);
    
        $this->notificationHistory[] = [
            "Time" => $notification->getTimeStamp(),
            "Status" => $notification->getStatus(),
            "Type" => $notification->getType(),
            "Message" => $messageText,
        ];
    }

    public function getNotificationHistory(): array
    {
        return $this->notificationHistory;
    }

    public function writeHistoryToFile(string $fileName): void
    {
        try {
            $file = fopen(__DIR__ . "/$fileName", "w");

            $notificationHistory = $this->getNotificationHistory();

            foreach ($notificationHistory as $message) {
                foreach ($message as $key => $value) {
                    fwrite($file, "$key: $value\n");                    
                }
                fwrite($file, "\n");
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        } finally {
            fclose($file);
        }
    }
}
