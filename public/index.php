<?php
session_start();
require "../vendor/autoload.php";
//session_destroy();
use App\Dispatcher;
if (!defined('constant')) define('SERVER',"localhost");
if (!defined('constant')) define('USER',"root");
if (!defined('constant')) define('PASSWORD',"");
if (!defined('constant')) define('BASE',"errecade_projet_5");
//Instanciation de la classe Dispatcher
$dispatch = new Dispatcher();
//Message entre l'objet $dispatch et la méthode dispatch() (déclarée dans la classe Dispatcher)
$dispatch->dispatch();
