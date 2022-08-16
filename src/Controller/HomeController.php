<?php
namespace App\Controller; 

use App\Model\HomeModel ;

class HomeController extends Controller{

    public function __construct(){
        parent::__construct();
        $this->model = new HomeModel();
    }

    /**
     * Gestion de l'affichage de la page d'accueil
     * 
     * @return void
     */
    public function indexAction(){
        echo $this->twig->render('home.html.twig');
    }


}