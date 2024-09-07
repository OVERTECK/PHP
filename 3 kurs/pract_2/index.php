<?php

class User
{
    public string $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

$arr = [new User("Михаил"), new User("Олег"), new User("Иван")];

foreach ($arr as $index => $obj) {
    if ($obj->name === "Олег") {
        unset($arr[$index]);
        print_r($obj);
    }
}

print_r($arr);
