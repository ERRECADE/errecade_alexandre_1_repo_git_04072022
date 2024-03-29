<?php

namespace App\Controller;

use App\Model\BlogModel;
use App\Model\UserModel;
use App\Model\CommentaireModel;

class ConnexionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->blog = new BlogModel();
        $this->user = new UserModel();
        $this->commentaire = new CommentaireModel();
    }

    /**
     * connexion espace admin
     *
     * @return void
     */
    public function connexionAction()
    {
        if (isset($_POST['floatingInput']) && isset($_POST['floatingPassword'])) {
            $email= $_POST['floatingInput'];
            $password = $_POST['floatingPassword'];
            $params = array(
                'email' => $email,
                'password' => $password
            );
            $user = $this->user->NewConnexion($params);

            if ($user == true) {
                $verifyPassword = password_verify($password, $user->getPassword());
                if ($verifyPassword) {
                    $_SESSION['user'] = $user;

                    $return = 
                    " <script> alert('Connexion réussi');
                    location.href = '/admin/blog/add'  </script>";
                    echo $return;
                } else {
                    $return = 
                    " <script> alert('Un problème est survenu lors de la connexion veuillez à nouveau essayer.');
                    location.href = '/connexion'  </script>";
                    echo $return;
                }
            } else {
                $return = 
                " <script> alert('Votre compte n'existe pas ou n'est pas encore validé.');
                location.href = '/connexion'  </script>";
                echo $return;
            }
        }
        echo $this->twig->render('connexion.html.twig');
    }
    /**
     * inscriptions d'un user
     *
     * @return void
     */
    public function inscriptionAction()
    {
        if (isset($_POST['floatingName']) && isset($_POST['floatingInput'])) {
            $nom = $_POST['floatingName'];
            $prenom = $_POST['floatingPrenom'];
            $email = $_POST['floatingInput'];
            $password = password_hash($_POST['floatingPassword'], PASSWORD_DEFAULT);
            $params = array(
                'nom' => $nom ,
                'prenom' => $prenom,
                'email' => $email,
                'password' => $password
            );
            $this->user->AddInscription($params);
        }
        echo $this->twig->render('inscription.html.twig');
    }
}
