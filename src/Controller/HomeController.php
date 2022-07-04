<?php
require "vendor/autoload.php";

include 'Model-repo/HomeModel.php';
include 'View-Service/HomeView.php';

class HomeController extends Controller{


    public function __construct(){
        $this->model = new HomeModel();
        $this->view = new HomeView();
    }

    /**
     * Gestion de l'affichage de la page d'accueil
     * 
     * @return void
     */
    public function indexAction(){
        $this->view->home();
    }

}