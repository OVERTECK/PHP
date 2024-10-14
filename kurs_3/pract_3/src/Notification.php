<?php

declare(strict_types=1);

namespace User\Pract3;

interface Notification
{
    public function send(string $message): void;
    public function getStatus(): string;
    public function getType(): string;
    public function getTimeStamp(): string;
}
