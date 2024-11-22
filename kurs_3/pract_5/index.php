<?php

namespace App;

use PDO;

require_once __dir__ . '\vendor\autoload.php';

$db = new DataBase();

$db->addUser(new User("Alex", "korkin.06@inbox.ru", "password"));

//$db->changeUserById(1, new User("Alex", "alex@gmail.com", "123456"));
//
//var_dump($db->getUsers());
//
//var_dump($db->searchUserByEmail("alex@gm1ail.com"));
//
//$db->deleteUserByLogin("Alex");