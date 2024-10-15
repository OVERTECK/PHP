<?php

declare(strict_types=1);

namespace User\Pract3;

use Exception;

require_once "vendor\\autoload.php";

date_default_timezone_set('Europe/Moscow');   

class EmailNotification extends AbstractNotification
{
    public function send(string $message): void
    {
        try {
            $type = $this->getType();

            echo "[$type] $message";

            $this->timestamp = date(DATE_ATOM);
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function setType(string $newType): void
    {
        $this->type = $newType;
    }
}
