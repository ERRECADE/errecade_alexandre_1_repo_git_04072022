<?php

namespace App\Controller;

use App\Model\BlogModel;
use App\Model\UserModel;
use App\Model\CommentaireModel;

class BlogController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->blog = new BlogModel();
        $this->user = new UserModel();
        $this->commentaire = new CommentaireModel();
    }

    /**
     * affichage des blogs
     *
     * @return void
     */
    public function blogAction()
    {
        $blogs = $this->blog->GetViewBlogs();
        echo $this->twig->render('blogTotal.html.twig', ['blogs' => $blogs]);
    }
    /**
     * affichage de la page modal des blogs
     *
     * @return void
     */
    public function blogModalAction(int $id)
    {
        $blogs = $this->blog->GetModalBlogs($id);
        $commentaires = $this->commentaire->GetCommentaireBlogs($id);

        if (isset($_POST['titre']) && isset($_POST['commentaire'])) {
            $titre = $_POST['titre'];
            $commentaires = $_POST['commentaire'];
            $blogId = $id;
            $params = array(
                'titre' => $titre ,
                'commentaire' => $commentaires,
                'blogId' => $blogId,
                'userId' => 1

            );
            $this->commentaire->AddCommeBlogs($params);
        }
        echo $this->twig->render('blogTotalModal.html.twig', ['blogs' => $blogs,'commentaires' => $commentaires]);
    }
}
