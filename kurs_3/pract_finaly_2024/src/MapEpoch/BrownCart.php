<?php

namespace App;

class BrownCart extends AbstractMapEpoch
{
    protected static string $color = "brown";

    protected array $production;

    public function __construct(
        $title,
        $production,
        $effect,
        $price,
        $numberEpoch,
        $minCountPlayers
    )
    {}
}