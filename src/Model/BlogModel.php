<?php
namespace App\Model;

use App\Controller\BlogController;
use App\View\BlogView ;

class BlogModel extends Model{
    public function GetViewBlogs(){
        try {
            $sth = $this->connexion->prepare(
                "SELECT b.id,
                b.titre,
                b.texte,
                b.chapo,
                b.created_at,
                u.nom,
                u.prenom,
                c.titre as titreCom,
                c.commentaire as commentaire,
                c.date as comDate
                FROM blog b
                LEFT JOIN users u ON u.id = b.users_id
                LEFT JOIN commentaire c ON c.id = b.id"
            );
            $sth->execute();
            return $sth->fetchAll();
        } catch (\Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
        
    }
    public function GetViewCommentaire(){
        try {
            $sth = $this->connexion->prepare(
                "SELECT c.id,
                c.titre,
                c.commentaire,
                c.date,
                c.id_blog as blogId,
                u.nom,
                u.prenom
                FROM commentaire c
                LEFT JOIN users u ON u.id = c.users_id"
            );
            $sth->execute();
            return $sth->fetchAll();
        } catch (\Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
        
    }

    public function AddCommeBlogs($params){
        error_log('lalalalala');
        error_log(print_r($params,true));
        try {
            $sth = $this->connexion->prepare(
                "INSERT INTO `commentaire` (`titre`, `commentaire`, `date`, `is_actif`, `created_at`, `update_at`, `users_id`) 
                 VALUES
                 ('com 3', 'zfsdcxv', '2022-07-15', '1', '2022-07-15', '2022-07-15', '2')"
            );
            $sth->execute();
            return $sth->fetchAll();
        } catch (\Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
        
    }
}