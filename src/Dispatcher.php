<?php
namespace App;


use App\Controller\Controller;
use App\Model\Model;
// Ici tous les controller qui correspondent a une page du site . 
class Dispatcher{

    public function dispatch(){
        error_log("1");

            $controller = $_GET['controller']??'home';// si une perssone vient ici directement 
            $controller = 'App\Controller\\'.ucfirst($controller) . 'Controller';

            $action = $_GET['action']??'index';
            $action = ucfirst($action) . 'Action';
            error_log($controller);
            error_log($action);
        
        
        

        $my_controller = new $controller();
        $my_controller->$action();
    }        

}
