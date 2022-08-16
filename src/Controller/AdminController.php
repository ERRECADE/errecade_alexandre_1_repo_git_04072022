<?php
namespace App\Controller; 

use App\Model\AdminModel ;

class AdminController extends Controller{

    public function __construct(){
        parent::__construct();
        $this->model = new AdminModel();
    }

    /**
     * Gestion de l'affichage de la page d'accueil
     * 
     * @return void
     */
    public function addBlogAction(){
        echo $this->twig->render('admin.html.twig');
    }
    public function commentaireAction(){
        echo $this->twig->render('admin.html.twig');
    }

    public function updateBlogAction(){
        echo $this->twig->render('admin.html.twig');
    }


}