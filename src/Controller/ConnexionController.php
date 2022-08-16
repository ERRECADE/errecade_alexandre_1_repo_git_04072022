<?php
namespace App\Controller; 

use App\Model\ConnexionModel ;

class ConnexionController extends Controller{

    public function __construct(){
        parent::__construct();
        $this->model = new ConnexionModel();
    }

    /**
     * Gestion de l'affichage de la page d'accueil
     * 
     * @return void
     */
    public function connexionAction(){
        echo $this->twig->render('connexion.html.twig');
    }
    /**
     * Gestion de l'affichage de la page d'accueil
     * 
     * @return void
     */
    public function inscriptionAction(){
        echo $this->twig->render('inscription.html.twig');
    }

}