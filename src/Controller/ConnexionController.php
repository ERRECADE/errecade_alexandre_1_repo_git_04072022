<?php
namespace App\Controller; 

use App\Model\BlogModel;
use App\Model\UserModel;
use App\Model\CommentaireModel;
class ConnexionController extends Controller{

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
    public function connexionAction(){
        if(isset($_POST['floatingInput']) && isset($_POST['floatingPassword'])){
            $email= $_POST['floatingInput'];
            $password = $_POST['floatingPassword'];
            $params = array(
                'email' => $email,
                'password' => $password
            );
            $user = $this->user->NewConnexion($params);

            if($user == true){
                $verifyPassword = password_verify($password,$user->getPassword());
                if($verifyPassword  ){
                    $_SESSION['user'] = $user;

                    header('Location: /admin/blog/add');

                }else{
                    header('Location: /connexion');
                }
            }else{
                header('Location: /connexion');
            }
        }
        echo $this->twig->render('connexion.html.twig');
        
        
    }
    /**
     * Gestion de l'affichage de la page d'accueil
     * 
     * @return void
     */
    public function inscriptionAction(){

        if(isset($_POST['floatingName']) && isset($_POST['floatingInput'])){
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
            // mettre des erreures si mauvaise inscriptions avec if et else un peut comme a la co 
        }
        echo $this->twig->render('inscription.html.twig');
    }



}