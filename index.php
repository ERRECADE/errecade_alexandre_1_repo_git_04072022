<?php

session_start();
//session_destroy();

include 'Dispatcher.php';
//Instanciation de la classe Dispatcher
$dispatch = new Dispatcher();

//Message entre l'objet $dispatch et la méthode dispatch() (déclarée dans la classe Dispatcher)
$dispatch->dispatch();