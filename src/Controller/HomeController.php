<?php
namespace App\Controller; 


class HomeController extends Controller{

    public function __construct(){
        parent::__construct();
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