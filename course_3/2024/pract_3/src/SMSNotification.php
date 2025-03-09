<?php

declare(strict_types=1);

namespace User\Pract3;

use Exception;

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
