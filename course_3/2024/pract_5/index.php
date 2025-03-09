<?php

namespace App;

use PDO;

require_once __dir__ . '/vendor/autoload.php';

$db = new DataBase(new MySQL("mysql:host=localhost;dbname=db_php;charset=utf8", "root", "root"));

$db->addUser(new User("112333", "korki111233n.06@inbox.ru", "password1234"));

//$db->changeUserById(1, new User("Alex", "alex@gmail.com", "123456"));
//
var_dump($db->getUsers());
//
//var_dump($db->searchUserByEmail("alex@gm1ail.com"));
//
//$db->deleteUserByLogin("Alex");