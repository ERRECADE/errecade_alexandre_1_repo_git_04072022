<?php
require "vendor/autoload.php";

include 'View-Service/View.php';
include 'Model-repo/Model.php';
include 'src/Controller/Controller.php';

// Ici tous les controller qui correspondent a une page du site . 
include 'src/Controller/HomeController.php';


class Dispatcher{

    public function dispatch(){
        
        // sans les sessions d'authentification
            $controller = $_GET['controller']??'home';// si une perssone vient ici directement 
            $controller = ucfirst($controller) . 'Controller';
        
            $action = $_GET['action']??'index';
            $action = $action . 'Action';
            //var_dump($controller);
            //var_dump($action);
        
        
        

        $my_controller = new $controller();
        $my_controller->$action();
    }        

}
