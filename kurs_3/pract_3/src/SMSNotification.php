<?php

declare(strict_types=1);

namespace User\Pract3;

use Exception;

require_once "vendor\\autoload.php";

date_default_timezone_set('Europe/Moscow');

class SMSNotification extends AbstractNotification
{
    public function send(string $message): void
    {
        try {
            echo $message;

            $this->timestamp = date(DATE_ATOM);
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
