<?php
session_start();
require "../vendor/autoload.php";
//session_destroy();
use App\Dispatcher;
//Instanciation de la classe Dispatcher
$dispatch = new Dispatcher();
//Message entre l'objet $dispatch et la méthode dispatch() (déclarée dans la classe Dispatcher)
$dispatch->dispatch();
