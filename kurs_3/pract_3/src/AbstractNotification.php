<?php

declare(strict_types=1);

namespace User\Pract3;

require_once "vendor\\autoload.php";

abstract class AbstractNotification implements Notification
{

   
    protected string $status;
    protected string $timestamp;
    protected string $type;

    public function __construct(string $status, string $type)
    {
        $this->status = $status;
        $this->type = $type;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
    public function getType(): string
    {
        return $this->type;
    }

    public function getTimeStamp(): string
    {
        return $this->timestamp;
    }

    abstract public function send(string $message): void;
}
