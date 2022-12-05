<?php
namespace App\Controller; 

use App\Model\BlogModel;
use App\Model\UserModel;
use App\Model\CommentaireModel;

class AdminController extends Controller{

    // public function __construct(blogModel $blogModel, UserModel $userModel, CommentaireModel $commentaireModel){
    //     parent::__construct();
    //     $this->blog = $blogModel;
    //     $this->user = $userModel;
    //     $this->commentaire = $commentaireModel;
    // }
    public function __construct(){
        parent::__construct();
        $this->blog = new BlogModel();
        $this->user = new UserModel();
        $this->commentaire = new CommentaireModel();

    }


    /**
     * Gestion de l'affichage de la page d'accueil
     * 
     * @return void
     */
    public function addBlogAction(){
    
        if(isset($_POST['titre']) && isset($_POST['texte'])){
            $titre = $_POST['titre'];
            $chapo = $_POST['chapo'];
            $texte = $_POST['texte'];
            $params = array(
                'titre' => $titre ,
                'chapo' => $chapo,
                'texte' => $texte,
                'userId' => '1'
            );
            $this->blog->AddBlogsNew($params);
        }
        echo $this->twig->render('adminAddBlog.html.twig');
    }

    public function commentaireAction(){
        if(isset($_POST['val']) || isset($_POST['inval'] )){
            $validation = isset($_POST['val']) ? 1 : 0;
            $id= $_POST['idCom'];
            $this->commentaire->UpdateComme($validation,$id);
            header('Location: /admin/commentaire');
        }
        $commentaire = $this->commentaire->GetCommentaireAdmin();
        echo $this->twig->render('adminCommentaire.html.twig', ['commentaire' => $commentaire]);
    }

    public function updateBlogAction(){
        $blogs = $this->blog->GetBlogupdate();

        if(isset($_POST['idCom'])){
            $id= $_POST['idCom'];
            $this->blog->DeleteBlogs($id);
            header('Location: /admin/update/blog');
        }
        echo $this->twig->render('adminUpdate.html.twig', ['blogs' => $blogs]);

    }


    /**
     * Gestion de l'affichage de la page modal 
     * 
     * @return void
     */
    public function updateblogModalAction(int $id){
        $blog = $this->blog->GetBlogupdateId($id); 

        if(!empty($_POST)){
            $titre = $_POST['titre'];
            $chapo = $_POST['chapo'];
            $texte = $_POST['texte'];
            $blogId = $id;
            $params = array(
                'titre' => $titre ,
                'chapo' => $chapo,
                'texte' => $texte,
                'blogId' => $blogId,
            );

            $this->blog->NewUpdateBlogs($params);

            header('Location: /admin/update/blog');

        }
        echo $this->twig->render('blogUpdate.html.twig',['blog' => $blog]);
    }


}