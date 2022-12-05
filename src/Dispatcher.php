<?php
namespace App;


use App\Controller\Controller;
use App\Model\Model;

use App\Controller\AdminController;
use App\Controller\BlogController;
use App\Controller\ConnexionController;
use App\Controller\HomeController;
class Dispatcher{

    public function dispatch(){


        $url = $_SERVER['REQUEST_URI'];

        if($url == '/admin/blog/add'){
            $controller = new AdminController;
            $controller->addBlogAction();
        }
        if($url == '/admin/commentaire'){
            $controller = new AdminController;
            $controller->commentaireAction();
        }
        if($url == '/admin/update/blog'){
            $controller = new AdminController;
            $controller->updateBlogAction();
        }
        if (preg_match('/^\/admin\/update\/blog\/modal\/(\d+)$/', $url, $matches)) {
            $id = (int)$matches[1];
            $controller = new AdminController;
            $controller->updateblogModalAction($id);
        }
        if($url == '/'){
            $controller = new HomeController;
            $controller->indexAction();
        }
        if($url == '/blog/total'){
            $controller = new BlogController;
            $controller->blogAction();
        }
        if (preg_match('/^\/blog\/modal\/(\d+)$/', $url, $matches)) {
            $id = (int)$matches[1];
            $controller = new BlogController;
            $controller->blogModalAction($id);
        }
        if($url == '/connexion'){
            $controller = new ConnexionController;
            $controller->connexionAction();
        }
        if($url == '/inscription'){
            $controller = new ConnexionController;
            $controller->inscriptionAction();
        }

    }        

}
