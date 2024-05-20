<?php

use Dotenv\Dotenv;
use Model\ActiveRecord;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
require 'config/database.php';

// Conectarse a la base de datos:
$db = conectarDB();
$db->set_charset('utf8');

ActiveRecord::setDB($db);