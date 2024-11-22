<?php

namespace App;

use PDO;

require_once __dir__ . '\vendor\autoload.php';

$db = new DataBase();
//$user = new User("root", "korkin.06@inbox.ru", "123456");

//$db->changeUserById(1, new User("Alex", "alex@gmail.com", "123456"));

//$db->addUser(new User("1233", "korkin3.06@inbox.ru", "password"));
//var_dump($db->getUsers());

//var_dump($db->searchUserByEmail("alex@gm1ail.com"));

$db->deleteUserByLogin("Alex");