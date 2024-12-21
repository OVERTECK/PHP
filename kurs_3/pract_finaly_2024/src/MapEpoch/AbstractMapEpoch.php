<?php

namespace App;

abstract class AbstractMapEpoch
{
    protected string $color;

    public function getColor(): string
    {
        return self::$color;
    }

    protected array $price;

    public function getPrice(): array
    {
        return $this->price;
    }

    protected string $effect;

    public function getEffect(): string
    {
        return $this->effect;
    }

    protected string $title;

    public function getTitle(): string
    {
        return $this->title;
    }

    protected string $charColorBlind;

    public function getCharColorBlind(): string
    {
        return $this->charColorBlind;
    }

    protected string $numberEpoch;

    public function getNumberEpoch(): string
    {
        return $this->numberEpoch;
    }

    protected int $minCountPlayers;

    public function getMinCountPlayers(): int
    {
        return $this->minCountPlayers;
    }
}