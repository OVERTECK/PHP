<?php

declare(strict_types=1);

namespace User\Pract3;

use Exception;

class NotificationManager
{
    /**
     * Summary of notificationHistory
     *
     * @var array<int, array<string, string>|null>
     */
    private array $notificationHistory = [];

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

    /**
     * Summary of getNotificationHistory
     *
     * @return array<int, array<string, string> | null>
     */
    public function getNotificationHistory(): array
    {
        return $this->notificationHistory;
    }

    /**
     * Summary of writeHistoryToFile
     *
     * @param  string $fileName
     * @return void
     */
    public function writeHistoryToFile(string $fileName): void
    {
        try {
            $file = fopen(__DIR__ . "/$fileName", "w");

            if ($file) {
                $notificationHistory = $this->getNotificationHistory();

                foreach ($notificationHistory as $message) {

                    if ($message !== null) {
                        foreach ($message as $key => $value) {
                            fwrite($file, "$key: $value\n");
                        }
                        fwrite($file, "\n");
                    }
                }

                fclose($file);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
