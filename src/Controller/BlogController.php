<?php
namespace App\Controller; 

use App\Model\BlogModel ;

class BlogController extends Controller{

    public function __construct(){
        parent::__construct();
        $this->model = new BlogModel();

    }

    /**
     * Gestion de l'affichage de la page d'accueil
     * 
     * @return void
     */
    public function blogAction(){
        $blogs = $this->model->GetViewBlogs(); 
        //$commentaires = $this->model->GetViewCommentaire();
        echo $this->twig->render('blogTotal.html.twig',['blogs' => $blogs]);

        if($_POST['nom'] && $_POST['commentaire']){
            $nom = $_POST['nom'];
            $commentaires = $_POST['commentaire'];
            //$blogId = $_POST['blogId'];
            $params = array(
                'nom' => $nom ,
                'commentaire' => $commentaires
                //'blogId' => $blogId
            );
            $this->model->AddCommeBlogs($params);
        }

    }

}